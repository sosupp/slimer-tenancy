<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;

class SlimerInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:install
                            {--m|migrate : Automatically run landlord migrations after publishing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform initial housekeeping for the Slimer Tenancy package (publish config, landlord migrations, env setup).';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("🚀 Starting Slimer Tenancy setup...");

        $this->publishAssets();
        $this->runMigrations();
        $this->updateEnv();

        $this->info("✅ Slimer Tenancy installation complete.");

        return self::SUCCESS;
    }

    private function publishAssets(): void
    {
        $this->line("📄 Publishing config...");
        $this->callSilent('vendor:publish', [
            '--tag' => 'slimer-tenancy-config',
            '--force' => true,
        ]);

        $this->line("📦 Publishing landlord migrations...");
        $this->callSilent('vendor:publish', [
            '--tag' => 'slimer-landlord-migrations',
            '--force' => true,
        ]);
    }

    private function updateEnv(): void
    {
        $this->line("📝 Updating .env file...");

        $domain = str(env('APP_NAME'))->lower()->value();

        $updates = [
            'SLIMER_TENANCY_ENABLED'       => 'true',
            'SLIMER_TENANCY_ROOT_DOMAIN'   => $domain,
            'SLIMER_TENANCY_LANDLORD_DOMAIN' => 'manage.'.$domain.'.test',
            'SLIMER_TENANCY_TENANT_DOMAIN' => 'null',
        ];

        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            $this->error("❌ .env file not found!");
            return;
        }

        $envContent = file_get_contents($envPath);

        foreach ($updates as $key => $value) {

            // If key exists, replace it
            if (preg_match("/^{$key}=.*/m", $envContent)) {
                $envContent = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    $envContent
                );
            }
            // Otherwise, append it
            else {
                $envContent .= PHP_EOL."{$key}={$value}";
            }
        }

        file_put_contents($envPath, $envContent);

        $this->info("🔧 Environment variables updated.");
    }

    private function runMigrations(): void
    {
        if ($this->option('migrate')) {
            $this->line("🛠  Running landlord migrations...");

            $this->call('migrate', [
                '--path' => 'database/migrations/landlord',
            ]);
        }
    }
}
