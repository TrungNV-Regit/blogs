@extends('layouts.master')

@section('title', 'Sign in')

@section('content')

@include('layouts.logo')

<div class="sign-up">
    <form action="{{route('auth.sign-in')}}" method="post">
        {{ csrf_field() }}

        <h4>Sign up</h4>

        <label for="eamil">Username or email <span>*</span></label>
        <input type="text" name="email">

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
                <input type="checkbox" name="remember" class="checkbox">
                <span>Remember password</span>
            </div>
            <div>
                <a>Forgot your password?</a>
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
@endsection
