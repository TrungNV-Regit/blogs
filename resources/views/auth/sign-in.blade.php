<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT Blogs | Sign in</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body>

    @include('component.notification')

    @include('component.logo')

    <div class="sign-up">
        <form action="{{route('auth.sign-in')}}" method="post">
            {{ csrf_field() }}

            <h4>Sign up</h4>

            <label for="eamil">Email <span>*</span></label>
            <input type="text" name="email" value="{{old('email')}}">

            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif

            <label for="username">Password <span>*</span></label>
            <input type="password" name="password">

            @if($errors->has('password'))
            <p>{{ $errors->first('password') }}</p>
            @endif

            <div class='option'>
                <div>
                    <input type="checkbox" name="remember" id="remember" class="checkbox">
                    <span>Remember password</span>
                </div>

                <div>
                    <a href="{{route('auth.forgot-password')}}">Forgot your password?</a>
                </div>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>

            <div>
                <a href="{{route('auth.sign-up')}}">Don’t have an account? Sign up here</a>
            </div>

        </form>
    </div>
</body>
</html>
