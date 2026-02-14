<?php


return [
    'enabled' => env('SLIMER_TENANCY_ENABLED', false),

    'root' => [
        'domain' => env('SLIMER_TENANCY_ROOT_DOMAIN'),
    ],

    'landlord' => [
        'domain' => env('SLIMER_TENANCY_LANDLORD_DOMAIN'),
        'model' => Sosupp\SlimerTenancy\Models\Landlord\Admin::class,
        'connection' => env('SLIMER_LANDLORD_CONNECTION', 'pgsql'),
        'jwt' => env('SLIMER_TENANCY_JWT', null),

    ],

    'tenant' => [
        'domain' => env('SLIMER_TENANCY_TENANT_DOMAIN', null),
        'model' => Sosupp\SlimerTenancy\Models\Landlord\Tenant::class,
        'connection' => env('SLIMER_TENANT_CONNECTION', 'tenant'),
        'database' => [
            'default' => 'pgsql',
            'schema' => true,
        ],

        'commands_after_migration' => [
            // 'app:default-tenant-seed'
        ]
    ],

];
