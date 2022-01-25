<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{URL::asset('/css/login.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="ttl">
    <h1>WELCOME</h1>
</div>

<div class="site__container">

    <div class="grid__container">

        <form action="{{url('loginIn')}}" method="post" class="form form--login">
            @csrf
            <div class="form__field">
                <input id="login__username" name='username' type="text" class="form__input" class="m-input">
                <label for="Username">Username</label>
            </div>

            <div class="form__field">
                <input id="login__password" name="password" type="password" class="form__input" lass="m-input">
                <label for="password">Password</label>
            </div>

            <div class="form__field">
                <input type="submit" value="Sign In">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>

    </div>

</div>

</body>
</html>