<?php

namespace Sosupp\SlimerTenancy\Services\Landlord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class LandlordTenantContext
{
    protected $originalConnection;
    private $jwt;


    public function run($tenant, \Closure $callback)
    {
        // dd(config('database.default'));
        // Save original connection
        $this->originalConnection = config('database.default');

        // Switch to tenant connection
        config([
            'database.default' => "tenant",
            'database.connections.tenant.schema' => $tenant->schema,
            // 'database.connections.tenant.search_path' => $tenant->schema . ',public',
        ]);

        App::instance('tenantId', $tenant->id);

        DB::purge();
        DB::reconnect();

        try {
            return $callback();
        } finally {
            // Revert connection
            config([
                'database.default' => $this->originalConnection,
                'database.connections.tenant.schema' => 'landlord',
            ]);

            App::instance('tenantId', null);

            DB::purge();
            DB::reconnect();
        }
    }

    public function runAsApi($tenant, \Closure $callback)
    {
        $this->jwt = config('slimertenaccy.jwt');

        if(is_null($this->jwt)){
            throw new \Exception('NO jwt token setup for api calls to tenant.');
        }

        try {

            return $callback();

        } catch (\Throwable $th) {

            throw $th;
        }

    }
}
