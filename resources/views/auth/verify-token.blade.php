<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT | Blog Verify Email</title>
    @vite(['resources/scss/app.scss'])
</head>

<body>
    
    @include('component.logo')

    <div class='verify-token'>

        @if (isset($data['success']))
        <div class="success">
            <p>{{ $data['success'] }}</p>
            <a href="{{ route('auth.sign-in') }}">Login</a>
        </div>
        @endif

        @if (isset($data['error']))
        <div class="success">
            <p>{{ $data['error'] }}</p>
        </div>
        @endif

    </div>
</body>
</html>
