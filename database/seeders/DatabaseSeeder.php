<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Bouncer;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\RolesEnum;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::firstOrCreate([
             'name' => RolesEnum::ADMIN->value,
             'email' => RolesEnum::ADMIN->value.'@gmail.com',
        ],
        [
             'name' => RolesEnum::ADMIN->value,
             'email' => RolesEnum::ADMIN->value.'@gmail.com',
             'password' => Hash::make(RolesEnum::ADMIN->value)
         ]);

        Bouncer::assign(RolesEnum::ADMIN->value)->to($user);
        

        $this->call([
            GenreSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class
        ]);

    }
}
