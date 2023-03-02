<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $csvBooks = fopen(base_path("public/Books.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvBooks, 256, ",")) !== FALSE) {
            if (!$firstline) {
                Book::firstOrCreate([
                    "name" => trim($data['0']),
                    "pages" => $data['1']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvBooks);
    }
}
