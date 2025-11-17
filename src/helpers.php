<?php

if(!function_exists('rootDomain')){
    function rootDomain()
    {
        return config('app.root_domain', parse_url(config('app.url'), PHP_URL_HOST));
    }

}

if(!function_exists('isLandlord')){
    function isLandlord()
    {
        $host = optional(request())->getHost();
        if(!str_starts_with($host, config('slimer-tenancy.landlord.domain'))){
            return false;
        }

        return true;
    }
}