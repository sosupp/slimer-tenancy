<?php
namespace Sosupp\SlimerTenancy\Services\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\PermissionRegistrar;
use Sosupp\SlimerTenancy\Models\Landlord\Tenant;

class TenantResolverService
{

    protected $resolvedTenant = null;

    public function resolve(Request $request): ?Tenant
    {
        // dd(config('slimertenancy.enabled'));
        if(config('slimertenancy.enabled')){
            // return null;
            if($this->resolvedTenant !== null){
                return $this->resolvedTenant;
            }

            $host = $request->getHost();

            // 1) Subdomain (acme.yourapp.com)
            $parts = explode('.', $host);
            $sub = $parts[0] ?? null;
            if ($sub && $sub !== 'www' && $sub !== config('slimertenancy.root.domain')) {
                $tenant = Tenant::where('subdomain', $sub)->first();
                // if ($tenant) return $tenant;

                if($tenant){
                    $this->switchConnection($tenant);
                    return $this->resolvedTenant = $tenant;
                }
            }

            // 2) Domain
            $tenant = Tenant::where('domain', $host)->first();

            // dd($host, $tenant);
            // if ($tenant) return $tenant;
            if($tenant){
                $this->switchConnection($tenant);
                return $this->resolvedTenant = $tenant;
            }

            // 3) Path prefix (/t/{slug})
            if ($request->segment(1) === 't') {
                $slug = $request->segment(2);
                if ($slug) {
                    $tenant = Tenant::where('slug', $slug)->first();
                    // if ($tenant) return $tenant;

                    if($tenant){
                        $this->switchConnection($tenant);
                        return $this->resolvedTenant = $tenant;
                    }
                }
            }

            // 4) Header
            if ($h = $request->header('X-Tenant')) {
                $tenant = Tenant::where('slug', $h)->first();
                // if ($tenant) return $tenant;
                if($tenant){
                    $this->switchConnection($tenant);
                    return $this->resolvedTenant = $tenant;
                }
            }

            return $this->resolvedTenant;
        }

        return null;
    }

    private function switchConnection($tenant)
    {
        // dd($tenant);
        if($tenant){
            App::instance('tenant', $tenant);
            App::instance('tenantId', $tenant->id);

            // handle spatie permission cache keys
            Config::set('permission.cache.key', 'spatie.permission.cache.tenant_' . $tenant->id);
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            config([
                'database.connections.tenant.schema' => $tenant->schema,
                'database.connections.tenant.search_path' => $tenant->schema . ',public',
            ]);

            config(['database.default' => 'tenant']);

            DB::purge('pgsql');
            DB::purge('tenant');
            DB::reconnect('tenant');
        }
    }
}
