<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\BookAuthor;
use App\Models\BookGenre;
use App\Models\UserBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{

    public function getBook()
    {
        return view('bookInfo', ['book' => Book::with('authors')->with('genres')->with('users')->where('id', request()->id)->first()]);
    }

    public function getAllBooks()
    {
       return view('home', ['books' => Book::with('authors')->get()]);
    }

    public function addBook()
    {
        return view('addBook', ['genres' => Genre::select('name')->get(), 'authors' => Author::select('name')->get()]);
    }

    public function addFavourites()
    {
        
        $user = User::where('id', Auth::user()->id)->first();

        $user->books()->attach(request()->id);

        return redirect()->back();


    }

    public function deleteFavourites()
    {
        
        $user = User::where('id', Auth::user()->id)->first();

        $user->books()->detach(request()->id);

        return redirect()->back();
        
    }

    public function getFavourites()
    {

        $favouriteBooks =  Book::whereHas('users', function ($user) {
            $user->where('user_id', Auth::user()->id);
        })->get();

        return view('home', ['books' => $favouriteBooks]);
    }
    


    public function create()
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'author' => 'required|array|max:255',
            'genre' => 'required|array|max:255',
            'pages' => 'required|integer|max:10000',
            'translated_by' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'name' => $validator->errors()->first('name'),
                        'author' => $validator->errors()->first('author'),
                        'genre' => $validator->errors()->first('genre'),
                        'pages' => $validator->errors()->first('pages'),
                        'translated_by' => $validator->errors()->first('translated_by')
                ]);
        }

        $book = Book::firstOrCreate([
            'name' => request('name'),
            'pages' =>  request('pages'),
            'translated_by' =>  request('translated_by')
        ]);

        if($book)
        {
            $authors = Author::whereIn('name', request('author'))->pluck('id')->toArray();
            $genres = Genre::whereIn('name', request('genre'))->pluck('id')->toArray();

            $book->authors()->attach($authors);
            $book->genres()->attach($genres);

            return response()->json([
                'redirect' => url('books'),
            ]);
        }

        throw new LogicException('Cannot create book');       
    }

    public function delete()
    {
        
        Book::where('id', request()->id)->delete();

        return redirect()->route('books');
    }

    public function exportGet()
    {
         return view('exportBooks');
    }

    public function exportCsv()
    {

        $fileName = 'books.csv';
        $books = Book::with('authors')->with('genres')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Authors', 'Genres', 'Pages', 'Translated by');

        $callback = function() use($books, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);


            foreach ($books as $book) {
                $row['Title'] = $book->name;
                $row['Authors'] = implode(', ', $book->authors->pluck('name')->toArray());
                $row['Genres'] = implode(', ', $book->genres->pluck('name')->toArray());
                $row['Pages'] = $book->pages;
                $row['Translated by'] = $book->translated_by;

                fputcsv($file, array($row['Title'], $row['Authors'], $row['Genres'], $row['Pages'], $row['Translated by']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
