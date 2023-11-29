<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT Blogs | Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body>
    @if (session('success'))
    <div class='notification'>
        {{ session('success') }}
    </div>
    @endif

    <div class="logo">
        <div>
            <a href="./index.html">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
                <span>RT-Blogs</span>
            </a>
        </div>
    </div>
    <div class="sign-up">
        <form action="/auth/sign-up" method="post">
            {{ csrf_field() }}

            <h4>Sign up</h4>

            <label for="username">Username <span>*</span></label>
            <input type="text" name="username" value="{{ old('username') }}">

            @if($errors->has('username'))
            <p>{{ $errors->first('username') }}</p>
            @endif

            <label for="username">Email <span>*</span></label>
            <input type="email" name="email" value="{{ old('email') }}">

            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif

            <label for="username">Password <span>*</span></label>
            <input type="password" name="password">

            @if($errors->has('password'))
            <p>{{ $errors->first('password') }}</p>
            @endif

            <label for="password">Password confirm <span>*</span></label>
            <input type="password" name="passwordConfirm">

            @if($errors->has('passwordConfirm'))
            <p>{{ $errors->first('passwordConfirm') }}</p>
            @endif

            <div>
                <button type="submit">Sign up</button>
            </div>

            <div>
                <a href="/auth/sign-in">Already have an account? Login</a>
            </div>

        </form>
    </div>

</body>

</html>