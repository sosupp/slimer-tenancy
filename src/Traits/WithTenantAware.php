<?php

namespace Sosupp\SlimerTenancy\Traits;

use Sosupp\SlimerTenancy\Services\Landlord\LandlordTenantContext;

trait WithTenantAware
{
    public function inTenant($tenant, \Closure $callback, bool $asApi = false)
    {
        $app = app(LandlordTenantContext::class);

        if($asApi){
            return $app->runAsApi($tenant, $callback);
        }

        return $app->run($tenant, $callback);
    }
}
