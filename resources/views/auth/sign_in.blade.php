@extends('layouts.master')

@section('title', 'Sign in')

@section('content')

<div class="sign-up">
    <div>

        @if (session('notification'))
        <div class='notification'>
            <span> {{ session('notification') }}</span>
        </div>
        @endif

        @include('layouts.logo')

        <div class="content">
            <form action="{{route('auth.sign-in')}}" method="post">
                {{ csrf_field() }}

                <h4>{{trans('message.sign_in')}}</h4>

                <label for="email">{{trans('message.username_or_email')}} <span>*</span></label>
                <input type="text" name="usernameOrEmail" value="{{old('usernameOrEmail')}}">

                @if($errors->has('usernameOrEmail'))
                <p>{{ $errors->first('usernameOrEmail') }}</p>
                @endif

                <label for="username">{{trans('message.password')}} <span>*</span></label>
                <input type="password" name="password">

                @if($errors->has('password'))
                <p>{{ $errors->first('password') }}</p>
                @endif

                @if(session('error'))
                <p>{{ session('error') }}</p>
                @endif

                <div class='option'>
                    <div>
                        <input type="checkbox" name="remember" class="checkbox">
                        <span>{{trans('message.remember_password')}}</span>
                    </div>
                    <div>
                        <a href="{{route('auth.forgot-password')}}">{{trans('message.forgot_password')}}</a>
                    </div>
                </div>
                <div>
                    <button type="submit">{{trans('message.login')}}</button>
                </div>
                <div>
                    <a href="{{route('auth.sign-up')}}">{{trans('message.not_exist_account')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
