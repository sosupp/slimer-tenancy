<?php

namespace Sosupp\SlimerTenancy\Console;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Services\Access\RolesCrudService;
use App\Services\Employees\UserCrudService;
use App\Services\Tenancy\TenantManagerService;
use App\Services\Employees\EmployeeCrudService;

class TenantMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tenant-migrate
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
                '--path' => 'database/migrations',
                '--database' => 'tenant',
            ];

            if ($this->option('fresh')) {
                Artisan::call('migrate:fresh', $params + [
                    '--force' => true,
                ]);
            } elseif ($this->option('refresh')) {
                Artisan::call('migrate:refresh', $params + [
                    '--force' => true,
                ]);
            } else {
                Artisan::call('migrate', $params + [
                    '--force' => true,
                ]);
            }

            // if ($this->option('seed')) {
            //     Artisan::call('db:seed', [
            //         '--class' => 'TenantDatabaseSeeder',
            //         '--database' => 'tenant',
            //         '--force' => true,
            //     ]);
            // }

            // Add master user or owner
            $this->call('business:roles');
            $role = (new RolesCrudService)->one(id: 1, name: 'owner');

            // dd($role);

            $user = (new UserCrudService)->make(
                id: null,
                data: [
                    'firstName' => $owner['firstName'],
                    'lastName' => $owner['lastName'],
                    'mobileNumber' => $owner['mobile'],
                    'email' => $owner['email'],
                    'role' => $role->id,
                    'type' => 'owner',
                ],
            );

            $employee = (new EmployeeCrudService)->make(
                id: null,
                data: [
                    'userId' => $user->id,
                    'firstName' => $owner['firstName'],
                    'lastName' => $owner['lastName'],
                    'mobileNumber' => $owner['mobile'],
                ],
            );

            $this->call('app:seed-regions');
            $this->call('business:add-setting');
            $this->call('business:expense-type');
            $this->call('app:add-income-type');
            $this->call('app:add-banking-type');
            $this->call('app:add-investment-type');
            $this->call('app:add-account-type');
            $this->call('app:add-account-mode');


            $this->line(Artisan::output());
        }

        $this->info('Done.');
    }
}
