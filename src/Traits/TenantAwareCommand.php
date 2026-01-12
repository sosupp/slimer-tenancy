<?php

namespace Sosupp\SlimerTenancy\Traits;

use Illuminate\Support\Facades\DB;
use Sosupp\SlimerTenancy\Services\Tenant\TenantManagerService;

trait TenantAwareCommand
{
    /**
     * Handle tenant-aware command execution.
     *
     * @param  \Closure  $callback  The logic to run per tenant.
     * @return void
     */
    public function handleTenantAware(\Closure $callback)
    {
        $tenant = null;
        $useTenant = config('slimertenancy.tenant.model');

        if(config('slimertenancy.enabled')){
            $tenantOption = $this->option('tenant');


            // dd($tenantOption);

            if ($tenantOption) {
                $tenant = $useTenant::where('id', $tenantOption)
                ->orWhere('slug', $tenantOption)
                ->orWhere('subdomain', $tenantOption)
                ->first();

                if (! $tenant) {
                    $this->error("❌ Tenant '{$tenantOption}' not found.");
                    return;
                }

                $this->info("🏠 Running for tenant: {$tenant->name}");
                $this->switchToTenant($tenant);

                try {
                    $callback($tenant);
                } finally {
                    $this->restoreCentralConnection();
                }

            } else {
                $this->info("🌍 Running for all tenants...");

                if($this->confirm('You are about to run for all tenants?')){
                    $tenants = $useTenant::all();
                    foreach ($tenants as $tenant) {
                        $this->info("🔹 Switching to tenant: {$tenant->name}");
                        $this->switchToTenant($tenant);

                        try {
                            $callback($tenant);
                        } catch (\Throwable $e) {
                            $this->error("❌ Error in tenant {$tenant->id}: " . $e->getMessage());
                        }

                        $this->restoreCentralConnection();
                    }

                    $this->info('✅ Tenant-aware operation completed.');
                    return;
                }

                $this->comment('No action performed...');
            }


            return;
        }

        return $callback($tenant);

    }

    /**
     * Switch to tenant database or schema.
     */
    protected function switchToTenant($tenant)
    {
        // Example for PostgreSQL schema-based tenancy
        // if (config('database.default') === 'pgsql') {
        //     DB::statement("SET search_path TO tenant_{$tenant->slug},public");
        // }

        $manager = (new TenantManagerService);
        $manager->setTenant($tenant);

        config(['database.default' => 'tenant']);


        // Example for database-per-tenant setup
        // if (isset($tenant->database)) {
        //     config(['database.connections.tenant.database' => $tenant->database]);
        //     DB::purge('tenant');
        //     DB::reconnect('tenant');
        //     DB::setDefaultConnection('tenant');
        // }
    }

    /**
     * Restore the central (default) connection.
     */
    protected function restoreCentralConnection()
    {
        DB::setDefaultConnection(config('database.default'));
    }
}
