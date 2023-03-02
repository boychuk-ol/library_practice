<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Book</title>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
  <body>

    @include('nav')

    <div class='canvas' style="margin-left:10px;margin-top:10px">

        <h3>{{ $book->name }}
        @if (Auth::check() && $book->users->where('id', Auth::user()->id)->first())
            <!--
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
            </svg>
            -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <!--
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
            -->
        @endif
        </h3>
        <ul class="list-group list-group-flush">
            <li>Authors: 
                @foreach($book->authors as $author)
                    @if (!$loop->last)
                        {{ $author->name }},
                    @else
                        {{ $author->name }}
                    @endif
                @endforeach
            </li>
            <li>Genres: 
                @foreach($book->genres as $genre)
                    @if (!$loop->last)
                        {{ $genre->name }},
                    @else
                        {{ $genre->name }}
                    @endif
                @endforeach
            </li>
            <li>Pages: {{ $book->pages }}</li>
            @if ($book->translated_by !== null)
                <li>Translated by: {{ $book->translated_by }}</li>
            @endif
        </ul>


        @can('manageFavs')
            @if (Auth::check() && !$book->users->where('id', Auth::user()->id)->first())
                <a href="{{ route('addfavourites', $book->id) }}"><button name="add" class="btn btn-outline-primary btn-sm ml-1">Add to favourites</button></a>   
            @else
                <a href="{{ route('deletefavourites', $book->id) }}"><button name="delete" class="btn btn-outline-danger btn-sm ml-1">Delete from favourites</button></a>  
            @endif
            @can('delete')
                <a href="{{ route('deletebook', $book->id) }}"><button name="delete" class="btn btn-outline-danger btn-sm ml-1">Delete book</button></a>  
            @endcan
        @endcan
    </div>

  </body>
</html>
