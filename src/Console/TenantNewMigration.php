<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Sosupp\SlimerTenancy\Traits\TenantAwareCommand;

class TenantNewMigration extends Command
{
    use TenantAwareCommand;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:tenant-new-migration {--tenant=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New migrations for one or all tenants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->handleTenantAware(function($tenant){

            $params = config('slimertenancy.enabled') ?
            [
                '--path' => 'database/migrations/tenant',
                '--database' => 'tenant',
                '--force' => true,
            ] :
            [
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ];

            Artisan::call('migrate', $params);
        });
    }
}
