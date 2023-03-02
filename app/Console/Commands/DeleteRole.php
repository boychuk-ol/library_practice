<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bouncer;

class DeleteRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:delete {rolename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete role from database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Bouncer::role()->where('name', $this->argument('rolename'))->delete();
        $this->info('Deleted successfully!');
    }
}
