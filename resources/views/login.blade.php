<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
    <form action="/login" method="post">
        @csrf
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input id="name" type="text" class="form-control" name='name' placeholder="Username" required="required">
        </div>

        <div style="display:none" id="name_error" class="alert alert-danger"></div>

        <div class="form-group">
            <input id="password" type="password" class="form-control" name='password' placeholder="Password" required="required">
        </div>

        <div style="display:none" id="password_error" class="alert alert-danger"></div>

        <div class="form-group">
            <button id="submit" type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
    </form>
    <p class="text-center"><a href="{{ route('register') }}">Create an Account</a></p>
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
            $('#password_error').hide();

            $.ajax({
                type:'POST',
                url:"{{ route('loginpost') }}",
                data:{
                    name: $('#name').val(),
                    password: $('#password').val(),
                },
                success:function(response){
                    if(response.name || response.password)
                    {
                        if(response.name)
                        {
                            $('#name_error').text(response.name);
                            $('#name_error').show();
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
