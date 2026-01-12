<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LandlordSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:landlord-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add landlord migrations, run database, add files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🚀 You are about to setup landlord system");
        
        if($this->confirm('Do you wish to contiune?')){
            // run slimer:landlord-migrate
            // run slimer:landlord-install
           
    
            
            return self::SUCCESS;
        }

        return self::SUCCESS;
    }


}
