<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT Blogs | Sign up</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body>

    @include('component.notification')

    @include('component.logo')

    <div class="sign-up">
        <form action="{{ route('auth.sign-up') }}" method="post">
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
                <a href="{{ route('auth.sign-in') }}">Already have an account? Login</a>
            </div>

        </form>
    </div>
</body>
</html>
