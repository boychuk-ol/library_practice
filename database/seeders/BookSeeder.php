<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $csvBooks = fopen(base_path("public/Books.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvBooks, 256, ",")) !== FALSE) {
            if (!$firstline) {

                $author = Author::firstOrCreate([
                    "name" => trim($data['1'])
                ]);
                $genre = Genre::firstOrCreate([
                    "name" => trim($data['2'])
                ]);
                $book = Book::firstOrCreate([
                    "name" => trim($data['0']),
                    "pages" => $data['3']
                ]);

                $attachedAuthors = $book->authors->pluck('id')->toArray();
                $attachedGenres = $book->genres->pluck('id')->toArray();

                if (!in_array($author->id, $attachedAuthors))
                {
                    $book->authors()->attach($author->id);
                }
                if (!in_array($genre->id, $attachedGenres))
                {
                    $book->genres()->attach($genre->id);
                }
            }
            $firstline = false;
        }
   
        fclose($csvBooks);
    }
}
