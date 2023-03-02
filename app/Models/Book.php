<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pages',
        'translated_by'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres')->using(BookGenre::class);
    }
    
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors')->using(BookAuthor::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_books')->using(UserBook::class);
    }
}
