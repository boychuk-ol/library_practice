<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .login-form {
        width: 340px;
        margin: 50px auto;
  	    font-size: 15px;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    </style>

</head>
<body>

    <div class="login-form">
        <form action="/register" method="post">
            @csrf
            <h2 class="text-center">Register</h2>       
            <div class="form-group">
                <input id="name" type="text" class="form-control" name='name' placeholder="Username">
            </div>

            <div style="display:none" id="name_error" class="alert alert-danger"></div>

            <div class="form-group">
                <input id="email" type="email" class="form-control" name='email' placeholder="Email">
            </div>

            <div style="display:none" id="email_error" class="alert alert-danger"></div>

            <div class="form-group">
                <input id="password" type="password" class="form-control" name='password' placeholder="Password">
            </div>

            <div style="display:none" id="password_error" class="alert alert-danger"></div>

            <div class="form-group">
                <input id="password_confirmation" type="password" class="form-control" name='password_confirmation' placeholder="Confirm password">
            </div>

            <div style="display:none" id="password_confirmation_error" class="alert alert-danger"></div>

            <div class="form-group">
                <button id="submit" type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <div class="clearfix">
            </div>        
        </form>
        <p class="text-center"><a href="{{ route('login') }}">Log in</a></p>
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
            $('#email_error').hide();
            $('#password_error').hide();

            $.ajax({
                type:'POST',
                url:"{{ route('registerpost') }}",
                data:{
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                },
                success:function(response){
                    if(response.name || response.email || response.password)
                    {
                        if(response.name)
                        {
                            $('#name_error').text(response.name);
                            $('#name_error').show();
                        }
                        if(response.email)
                        {
                            $('#email_error').text(response.email);
                            $('#email_error').show();
                        }
                        if(response.password)
                        {
                            $('#password_error').text(response.password);
                            $('#password_error').show();
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
