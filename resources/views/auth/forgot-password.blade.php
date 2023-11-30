<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT Blogs | Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
    @vite(['resources/scss/app.scss'])
</head>

<body            >

    @include('component.logo')

    <div class="sign-up">
        <form action="{{route('auth.forgot-password')}}" method="post">
            {{ csrf_field() }}

            <h4>Forgot Password</h4>

            <label for="eamil">Email <span>*</span></label>
            <input type="text" name="email" value="{{old('email')}}">

            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif

            @if (session('notification'))
            <p>{{ $session('notification') }}</p>
            @endif

            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
