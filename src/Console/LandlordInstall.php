<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LandlordInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:landlord-install
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add commonly used landlord dashboard files and classes for easy kickoff. The Slimer Landlord dashboard utilities livewire and slim-dashboard package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🚀 Installing Slimer landlord dashboard components...");

        if($this->confirm('Do you wish to contiune?')){
            // Publish the default and common Landlord livewire components
            $stubFiles = [
                'BaseLayout',
                'DemoList',
                'LandlordHome',
                'PackagesList',
                'TenantList',
                'TenantManage',
                'TenantOverview',
                'TenantSettings',
            ];

            foreach ($stubFiles as $file) {
                $stubPath = __DIR__ . "/Stubs/{$file}.stub";
                $stub = file_get_contents($stubPath);

                $targetDir = app_path("Livewire/Landlord");
                $targetFile = "{$targetDir}/{$file}.php";

                // dd($stubPath, $file, File::exists($stubPath), $targetDir, $targetFile, File::ensureDirectoryExists($targetDir));
                if (!File::exists($stubPath)) {
                    $this->error("Invalid source file: {$file}");
                    return;
                }

                if (File::exists($targetFile) && ! $this->option('force')) {
                    $this->warn("File {$file} already exists. Use --force to overwrite.");
                    // return;
                    continue;
                }

                File::ensureDirectoryExists($targetDir);

                // Replace content/placeholders
                $content = str_replace(
                    '{{ namespace }}',
                    "App\\Livewire\\Landlord",
                    $stub
                );

                file_put_contents($targetFile, $content);

                $this->info("Landlord file {$file} installed successfully.");
            }


            return self::SUCCESS;
        }

        return self::SUCCESS;
    }


}
