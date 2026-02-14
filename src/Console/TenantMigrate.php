<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Sosupp\SlimerTenancy\Models\Landlord\Tenant;
use Sosupp\SlimerTenancy\Services\Tenant\TenantManagerService;

class TenantMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:tenant-migrate
                    {--tenant=} {--owner} {--fresh} {--refresh} {--seed}
                    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run tenant migrations on one or all tenants';

    /**
     * Execute the console command.
     */
    public function handle(TenantManagerService $manager)
    {
        $tenantId = $this->option('tenant');
        $owner = $this->option('owner');

        // dd($tenantId, $owner, $owner['firstName'], $this->options());

        $tenants = $tenantId
            ? Tenant::where('id', $tenantId)->get()
            : [];

        foreach ($tenants as $tenant) {
            $this->info("Migrating tenant {$tenant->name} ({$tenant->id})...");
            $manager->setTenant($tenant);

            $params = [
                '--path' => 'database/migrations/tenant',
                '--database' => 'tenant',
                '--force' => true,
            ];

            if ($this->option('fresh')) {
                Artisan::call('migrate:fresh', $params);
                $this->onFirstRun($tenantId, $owner);

            } elseif ($this->option('refresh')) {
                Artisan::call('migrate:refresh', $params);
                $this->onFirstRun($tenantId, $owner);
            } else {
                Artisan::call('migrate', $params);
            }

            $this->line(Artisan::output());
        }

        $this->info('Done.');
    }

    private function onFirstRun($tenantId, $owner)
    {
        // Pass in dynamic commands that will be called to seed default data if needed
            // after database is migrated

            $commands = config('slimetenancy.tenant.commands_after_migration');

            if($commands){
                foreach($commands as $command){
                    $this->call($command, [
                        '--tenant' => $tenantId,
                        '--owner' => $owner,
                    ]);
                }
            }
    }
}
