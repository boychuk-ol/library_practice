<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Bouncer;

class RetractUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:retractfromuser {rolename} {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retract role from user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::where('name', $this->argument('username'))->first();
        if ($user)
        {
            Bouncer::retract($this->argument('rolename'))->from($user);
            $this->info('Retracted successfully!');
        }
    }
}
