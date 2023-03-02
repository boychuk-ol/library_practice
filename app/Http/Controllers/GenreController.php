<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{

    public function addGenre()
    {

        return view('addGenre');
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:150|unique:genres,name',
        ]);


        if ($validator->fails()) {
            return response()->json([
                        'name' => $validator->errors()->first('name')
                    ]);
        }


        $genre = Genre::firstOrCreate(request(['name']));

        if($genre)
        {
            return response()->json([
                    'redirect' => url('books'),
                ]);
        }

        throw new LogicException('Cannot create genre');    
    }
}
