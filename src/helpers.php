<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Sosupp\SlimerTenancy\Models\Tenant\TenantUtility;

if(!function_exists('rootDomain')){
    function rootDomain()
    {
        return config('slimertenancy.root.domain', parse_url(config('app.url'), PHP_URL_HOST));
    }

}

if(!function_exists('isLandlord')){
    function isLandlord()
    {
        $host = optional(request())->getHost();
        if(!str_starts_with($host, config('slimertenancy.landlord.domain'))){
            return false;
        }

        return true;
    }
}


if (!function_exists('cleanName')) {
    function cleanName(string $name): string
    {
        $cleaned = preg_replace('/[^a-zA-Z0-9]/', '', $name);
        return Str::lower($cleaned);
    }
}   

if (!function_exists('tenantPrefix')) {
    function tenantPrefix()
    {
        $tenantId = app()->has('tenantId') ? app('tenantId') .'_' : '';

        Log::info('tenant_id', [$tenantId]);
        return $tenantId;
    }
}

if (!function_exists('tenantUrl')) {
    function tenantUrl(string $shortName): string|null
    {
        return $shortName.'.'.rootDomain();
    }
}

if (! function_exists('tenantImagePath')) {
    function tenantImagePath(?string $tenantId = null)
    {
        $tenant = $tenantId ?: app('tenant')['subdomain'];
        return "tenants/{$tenant}/images";
    }
}

if (! function_exists('tenantDocPath')) {
    function tenantDocPath(?string $tenantId = null)
    {
        $tenant = $tenantId ?: app('tenant')['subdomain'];
        return "tenants/{$tenant}/documents";
    }
}

if(! function_exists('tenantHasSms')){
    function tenantHasSms()
    {
        return config('slimertenancy.models.utility')::query()
        ->where('name', 'sms_credit')
        ->first()
        ->value > 0;
    }
}