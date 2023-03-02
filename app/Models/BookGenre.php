<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookGenre extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'genre_id'
    ];

    public $timestamps = false;
}
