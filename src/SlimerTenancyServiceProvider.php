<?php
namespace Sosupp\SlimerTenancy;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sosupp\SlimerTenancy\Console\TenantCreate;
use Sosupp\SlimerTenancy\Console\LandlordAdmin;
use Sosupp\SlimerTenancy\Console\LandlordInstall;
use Sosupp\SlimerTenancy\Console\SlimerInstall;
use Sosupp\SlimerTenancy\Console\TenantMigrate;
use Sosupp\SlimerTenancy\Console\LandlordMigrate;
use Sosupp\SlimerTenancy\Console\TenantNewMigration;
use Sosupp\SlimerTenancy\Services\Tenant\TenantResolverService;


class SlimerTenancyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Register bindings, singletons, etc.
        $this->app->singleton(TenantResolverService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Publish config, migrations, routes, etc.
        $this->decideConnection();

        if($this->app->runningInConsole()){
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('slimertenancy.php'),
            ], 'slimer-tenancy-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'slimer-landlord-migrations');

            $this->publishes([
                __DIR__ .'/../routes/landlord.php' => base_path('routes/landlord.php')
            ], 'slimer-landlord-routes');

        }

        // Commands
        $this->customCommands();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'slimer-tenancy');
    }

    protected function decideConnection()
    {
        // dd($this->app);
        if(config('slimertenancy.enabled')){

            if(!isLandlord()){
                return $this->configureTenantConnection();
            }

            // dd("is landlord");
            // Most possible a landlord
            config([
                'database.connections.pgsql.schema' => 'landlord',
                'database.connections.pgsql.search_path' => 'landlord,public',
            ]);

            DB::purge('pgsql');
            DB::purge('tenant');
            DB::reconnect('pgsql');

            $this->loadLandlordRoutes();
        }
    }

    protected function configureTenantConnection()
    {
        $tenant = (new TenantResolverService)->resolve(request: request());

        // If tenant continue else back to landing page
        if($tenant){
            return $this->loadTenantRoutes();
        }

        // No Tenant found: Return to landing page
        redirect()->away(request()->getScheme() . "://".rootDomain());
    }

    protected function customCommands()
    {
        $this->commands([
            SlimerInstall::class,
            LandlordMigrate::class,
            LandlordInstall::class,
            LandlordAdmin::class,
            TenantMigrate::class,
            TenantNewMigration::class,
            TenantCreate::class,
        ]);
    }

    protected function loadLandlordRoutes()
    {
        if($this->app->booted(function(){
            return Route::middleware(['web'])
            ->group(base_path('routes/landlord.php'));
        }));

    }

    protected function loadTenantRoutes()
    {
        if($this->app->booted(function(){
            $this->loadRoutesFrom(__DIR__.'/../routes/tenants.php');

            Route::middleware(['web'])
            ->group(base_path('routes/tenant.php'));
        }));
    }

}
