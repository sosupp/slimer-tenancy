<?php


return [
    'enabled' => env('SLIMER_TENANCY_ENABLED', true),

    'root' => [
        'domain' => env('SLIMER_TENANCY_ROOT_DOMAIN', 'susu-crm.test'),
    ],

    'landlord' => [
        'domain' => env('SLIMER_TENANCY_LANDLORD_DOMAIN', 'manage.susu-crm.test'),
        'model' => Sosupp\SlimerTenancy\Models\Landlord\Landlord::class,
        'connection' => env('SLIMER_LANDLORD_CONNECTION', 'pgsql'),

    ],

    'tenant' => [
        'domain' => env('SLIMER_TENANCY_TENANT_DOMAIN', null),
        'model' => Sosupp\SlimerTenancy\Models\Landlord\Tenant::class,
        'connection' => env('SLIMER_TENANT_CONNECTION', 'tenant'),
        'database' => [
            'default' => 'pgsql',
            'schema' => true,
        ]
    ],

];
