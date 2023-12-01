@extends('layouts.master')

@section('title', 'Sign up')

@section('content')
    @if (session('success'))
    <div class='notification'>
        <span> {{ session('success') }}</span>
    </div>
    @endif

    <div class="logo">
        <div>
            <a href="{{route('/home')}}">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
                <span>RT-Blogs</span>
            </a>
        </div>
    </div>
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
            <input type="password" name="password_confirmation">

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
@endsection
