<!DOCTYPE html>
<html>
<head>
    <title>Fotgot Password</title>
</head>
<body>
    <h2>Hello, this is your new password : {{$content}}</h2>
    <a href="{{config('app.constants.BASE_URL').'/auth/sign-in'}}">Login</a>
    <br/>
    <strong>Thanks.</strong>
</body>
</html>
