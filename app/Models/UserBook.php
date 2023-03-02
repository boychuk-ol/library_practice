<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserBook extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id'
    ];

    public $timestamps = false;
}
