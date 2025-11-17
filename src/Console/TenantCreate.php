<?php

namespace Sosupp\SlimerTenancy\Console;

use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TenantCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tenant-create {name} {firstName?}
                {lastName?} {email?} {mobile?} {slug?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a tenant (schema-per-tenant)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');
        $email = $this->argument('email');
        $mobile = $this->argument('mobile');
        $slug = $this->argument('slug') ?? Str::slug($name);
        $id   = Str::uuid()->toString();
        $schema = 'tenant_'.$slug; // or '_'.$id

        // dd($id, $name, $schema);

        DB::statement("CREATE SCHEMA IF NOT EXISTS {$schema}");

        $tenant = Tenant::query()
        ->updateOrCreate(
            [
                'name' => $name,
                'slug' => $slug,
            ],
            [
                'schema' => $schema,
            ]
        );

        $this->call('app:tenant-migrate', [
            '--tenant' => $tenant->id,
            '--refresh' => true,
            '--owner' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
            ]
        ]);

        $this->info("Tenant {$tenant->name} created with schema {$schema}");
    }
}
