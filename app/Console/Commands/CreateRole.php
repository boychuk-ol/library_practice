<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bouncer;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:create {rolename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add role to database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Bouncer::role()->firstOrCreate([
            'name' => $this->argument('rolename')
        ]);
        $this->info('Created successfully!');
    }
}
