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
        <h4>Add author:</h4>
        <form method="post" action="/addauthor">
        @csrf
          <div class="form-group">
            <label>Full name</label>
            <input id="name" type="text" class="form-control" name="name" placeholder="Name">
          </div>

          <div style="display:none" id="name_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Pseudonym</label>
            <input id="pseudonym" type="text" class="form-control" name="pseudonym" placeholder="Pseudonym">
          </div>

          <div style="display:none" id="pseudonym_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Born</label>
            <input id="born" type="date" class="form-control" name="born" placeholder="Born">
          </div>

          <div style="display:none" id="born_error" class="alert alert-danger"></div>

          <div class="form-group">
            <label>Nationality</label>
            <input id="nationality" type="text" class="form-control" name="nationality" placeholder="Nationality">
          </div>

          <div style="display:none" id="nationality_error" class="alert alert-danger"></div>

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
            $('#pseudonym_error').hide();
            $('#born_error').hide();
            $('#nationality_error').hide();

            $.ajax({
                type:'POST',
                url:"{{ route('addauthorpost') }}",
                data:{
                    name: $('#name').val(),
                    pseudonym: $('#pseudonym').val(),
                    born: $("#born").val(),
                    nationality: $("#nationality").val()
                },
                success:function(response){
                    if(response.name || response.pseudonym || response.born || response.nationality)
                    {
                        if(response.name)
                        {
                            $('#name_error').text(response.name);
                            $('#name_error').show();
                        }
                        if(response.pseudonym)
                        {
                            $('#pseudonym_error').text(response.pseudonym);
                            $('#pseudonym_error').show();
                        }
                        if(response.born)
                        {
                            $('#born_error').text(response.born);
                            $('#born_error').show();
                        }
                        if(response.nationality)
                        {
                            $('#nationality_error').text(response.nationality);
                            $('#nationality_error').show();
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
