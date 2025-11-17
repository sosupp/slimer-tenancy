

<?php
namespace Sosupp\SlimerTenancy;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Sosupp\SlimerTenancy\Services\Tenancy\TenantResolverService;


class SlimerTenancyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Register bindings, singletons, etc.
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Publish config, migrations, routes, etc.

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('slimertenancy.php'),
        ]); 

        $this->decideConnection();

    
    }

    protected function decideConnection()
    {
        if(config('slimer.tenancy.enabled')){
            if(!isLandlord()){
                return $this->configureTenantConnection();
            }
    
            config([
                'database.connections.pgsql.schema' => 'landlord',
                'database.connections.pgsql.search_path' => 'landlord,public',
            ]);
    
            DB::purge('pgsql');
            DB::purge('tenant');
            DB::reconnect('pgsql');
        }
    }

    protected function configureTenantConnection()
    {
        $tenant = (new TenantResolverService)->resolve(request: request());

        // dd($tenant, $tenant?->schema);
        // If tenant continue else back to landing page
        if($tenant){
            config([
                'database.connections.tenant.schema' => $tenant->schema,
                'database.connections.tenant.search_path' => $tenant->schema . ',public',
            ]);

            config(['database.default' => 'tenant']);

            DB::purge('pgsql');
            DB::purge('tenant');
            DB::reconnect('tenant');

            return;
        }


        // dd("not a tenant");

        // Return to landing page

        return redirect()->away(request()->getScheme() . "://".rootDomain());
    }

}