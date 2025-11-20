<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class LandlordMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:landlord-migrate {--fresh} {--refresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for the landlord schema in susu_crm_dev database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // dd(DB::connection());
        $this->info('Checking landlord schema...');

        // Create landlord schema if not exists
        DB::connection('pgsql')->statement('CREATE SCHEMA IF NOT EXISTS landlord');

        $params = [
            '--path' => 'database/migrations/landlord',
            '--database' => 'pgsql',
            '--force' => true,
        ];

        if ($this->option('fresh')) {
            $this->warn('Running fresh landlord migrations...');
            Artisan::call('migrate:fresh', $params);
        } elseif ($this->option('refresh')) {
            $this->warn('Running refresh landlord migrations...');
            Artisan::call('migrate:refresh', $params);
        } else {
            $this->info('Running landlord migrations...');
            Artisan::call('migrate', $params);
        }

        $this->line(Artisan::output());

        if ($this->option('seed')) {
            $this->info('Seeding landlord database...');

            Artisan::call('db:seed', [
                '--class' => 'LandlordSeeder',
                '--database' => 'pgsql',
                '--force' => true,
            ]);

            $this->line(Artisan::output());
        }

        $this->info('Landlord migrations completed.');

    }
}
