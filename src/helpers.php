<?php

use Illuminate\Support\Str;

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