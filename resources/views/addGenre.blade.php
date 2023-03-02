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
        <h4>Add genre:</h4>
        <form action="/addgenre" method="post">
        @csrf
          <div class="form-group">
            <label>Book name</label>
            <input id="name" type="text" class="form-control" name="name" placeholder="Genre">
          </div>

          <div id="name_error" style="display:none" class="alert alert-danger"></div>

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

            $.ajax({
                type:'POST',
                url:"{{ route('addgenrepost') }}",
                data:{
                    name: $('#name').val(),
                },
                success:function(response){
                    if(response.name)
                    {
                        $('#name_error').text(response.name);
                        $('#name_error').show();
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
