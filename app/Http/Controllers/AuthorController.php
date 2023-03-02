<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function addAuthor()
    {
        return view('addAuthor');
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:200|unique:authors,name',
            'pseudonym' => 'nullable|max:200',
            'born' => 'nullable|date|before:today',
            'nationality' => 'nullable|max:100',
        ]);


        if ($validator->fails()) {
            return response()->json([
                        'name' => $validator->errors()->first('name'),
                        'pseudonym' => $validator->errors()->first('pseudonym'),
                        'born' => $validator->errors()->first('born'),
                        'nationality' => $validator->errors()->first('nationality')
                    ]);
        }

        $author = Author::firstOrCreate(request(['name', 'pseudonym', 'born', 'nationality']));

        if($author)
        {
            return response()->json([
                'redirect' => url('books'),
            ]);
        }

        throw new LogicException('Cannot create author');        
    }
}
