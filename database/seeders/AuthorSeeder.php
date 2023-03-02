<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $csvAuthors = fopen(base_path("public/Authors.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvAuthors, 256, ",")) !== FALSE) {
            if (!$firstline) {
                Author::firstOrCreate([
                    "name" => trim($data['0']),
                    "pseudonym" => trim($data['1'])
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvAuthors);
    }
}
