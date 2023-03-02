<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $csvGenres = fopen(base_path("public/Genres.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvGenres, 200, ",")) !== FALSE) {
            if (!$firstline) {
                Genre::firstOrCreate([
                    "name" => trim($data['0']),
                ]);    
            }
            $firstline = false;
        }
    }
}
