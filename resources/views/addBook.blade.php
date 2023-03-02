<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Home</title>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
  <body>

    @include('nav')

    <div class='canvas' style="width:30%;margin-left:10px;margin-top:10px;">

        <h4>Add the book:</h4>

        <form action="/addbook" method="post">
        @csrf

          <div class="form-group">
            <label>Book name</label>
            <input id="name" type="text" class="form-control" name="name" placeholder="Name">
          </div>

          <div style="display:none" id="name_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Authors:</label>
            <select id="author" class="form-select ml-3" name="author[]" multiple aria-label="multiple select example">
                @foreach ($authors as $author)
                  <option value="{{ $author->name }}">{{ $author->name }}</option>
                @endforeach
            </select>
            <p style="display:inline;margin-left:7px">or <a href="{{route('addauthor')}}">Add author</a></p>
          </div>

          <div style="display:none" id="author_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Genres:</label>
            <select id="genre" class="form-select ml-3" name="genre[]" multiple aria-label="multiple select example">
                @foreach ($genres as $genre)
                  <option value="{{ $genre->name }}">{{ $genre->name }}</option>
                @endforeach
            </select>
            <p style="display:inline;margin-left:7px">or <a href="{{route('addgenre')}}">Add genre</a></p>
          </div>

          <div style="display:none" id="genre_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Pages</label>
            <input id="pages" type="number" class="form-control" name="pages" placeholder="Pages">
          </div>

          <div style="display:none" id="pages_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Translated by</label>
            <input id="translated_by" type="text" class="form-control" name="translated_by" placeholder="Translated by">
          </div>

          <div style="display:none" id="translated_by_error" class="alert alert-danger"></div>

          <button id="submit" type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit').click(function(e) {

            e.preventDefault();

            $('#name_error').hide();
            $('#author_error').hide();
            $('#genre_error').hide();
            $('#pages_error').hide();
            $('#translated_by_error').hide();

            $.ajax({
                type:'POST',
                url:"{{ route('addbookpost') }}",
                data:{
                    name: $('#name').val(),
                    author: $('#author').val(),
                    genre: $("#genre").val(),
                    pages: $("#pages").val(),
                    translated_by: $("#translated_by").val()
                },
                success:function(response){
                    if(response.name || response.author || response.genre || response.pages || response.translated_by)
                    {
                        if(response.name)
                        {
                            $('#name_error').text(response.name);
                            $('#name_error').show();
                        }
                        if(response.author)
                        {
                            $('#author_error').text(response.author);
                            $('#author_error').show();
                        }
                        if(response.genre)
                        {
                            $('#genre_error').text(response.genre);
                            $('#genre_error').show();
                        }
                        if(response.pages)
                        {
                            $('#pages_error').text(response.pages);
                            $('#pages_error').show();
                        }
                        if(response.translated_by)
                        {
                            $('#translated_by_error').text(response.translated_by);
                            $('#translated_by_error').show();
                        }
                    }
                    else
                    {
                        window.location = response.redirect;
                    }
                },
                error:function(response){
                    console.log('error');
                }
            });

        });  

  </script>

  </body>
</html>
