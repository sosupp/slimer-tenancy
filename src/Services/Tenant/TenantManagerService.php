<?php
namespace Sosupp\SlimerTenancy\Services\Tenant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Sosupp\SlimerTenancy\Models\Landlord\Tenant;

class TenantManagerService
{
    protected ?Tenant $tenant = null;

    public function setTenant(Tenant $tenant): void
    {

        $this->tenant = $tenant;

        config([
            'database.connections.tenant.schema' => $tenant->schema,
            'database.connections.tenant.search_path' => $tenant->schema . ',public',
        ]);

        DB::purge('pgsql');
        DB::purge('tenant');
        DB::reconnect('tenant');
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }
}
