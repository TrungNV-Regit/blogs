@extends('layouts.master')

@section('title', 'Sign up')

@section('content')

<div class='sign-up'>
    <div>
        @if (session('success'))
        <div class='notification'>
            <span> {{ session('success') }}</span>
        </div>
        @endif

        @include('layouts.logo')

        <div class="content">
            <form action="{{ route('auth.sign-up') }}" method="post">
                {{ csrf_field() }}

                <h4>Sign up</h4>

                <label for="username">Username <span>*</span></label>
                <input type="text" name="username" id='username' value="{{ old('username') }}">

                @if($errors->has('username'))
                <p>{{ $errors->first('username') }}</p>
                @endif

                <label for="username">Email <span>*</span></label>
                <input type="email" name="email" id=email value="{{ old('email') }}">

                @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif

                <label for="username">Password <span>*</span></label>
                <input type="password" id='password' name="password">

                @if($errors->has('password'))
                <p>{{ $errors->first('password') }}</p>
                @endif

                <label for="password">Password confirm <span>*</span></label>
                <input type="password" name="password_confirmation" id='password_confirmation'>

                @if($errors->has('password'))
                <p>{{ $errors->first('password') }}</p>
                @endif

                <div>
                    <button type="submit">Sign up</button>
                </div>
                <div>
                    <a href="{{ route('auth.sign-in') }}">Already have an account? Login</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
