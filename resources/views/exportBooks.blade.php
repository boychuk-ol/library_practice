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
        @can('exportbooks')
            <a href="{{ route('exportbooksCsv') }}"><button name="add" class="btn btn-outline-primary btn-sm ml-1">Export books as csv</button></a>   
        @endcan
    </div>

  </body>
</html>
