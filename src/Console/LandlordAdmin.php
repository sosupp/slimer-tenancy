<?php

namespace Sosupp\SlimerTenancy\Console;

use Illuminate\Console\Command;
use Sosupp\SlimerTenancy\Services\Landlord\LandlordCrudService;

class LandlordAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slimer:landlord-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new landlord admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        config(['database.default' => 'pgsql']);

        $name = $this->ask('full name');
        $email = $this->ask('email');
        $mobile = $this->ask('mobile');

        $type = $this->choice('Admin type', [
            'owner', 'admin', 'super_admin', 'sale_engineer'
        ], 0);

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $mobile,
            'adminType' => $type,
        ];

        $admin = (new LandlordCrudService())->make(null, $data);

        $this->info('Admin created successfully.');
    }
}
