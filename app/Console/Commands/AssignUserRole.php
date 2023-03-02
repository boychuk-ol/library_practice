<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Bouncer;

class AssignUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:assigntouser {rolename} {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role to user. Create if no such a role';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::where('name', $this->argument('username'))->first();
        if ($user)
        {
            Bouncer::assign($this->argument('rolename'))->to($user);
            $this->info('Assigned successfully!');
        }
    }
}
