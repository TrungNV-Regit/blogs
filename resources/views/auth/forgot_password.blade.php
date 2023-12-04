@extends('layouts.master')

@section('title', 'Forgot Password')

@section('content')

<div class="sign-up">
    <div>

        @include('layouts.logo')

        <div class="content">
            <form action="{{route('auth.forgot-password')}}" method="post">
                {{ csrf_field() }}

                <h4>{{trans('message.title_forgot_password')}}</h4>

                <label for="email">{{trans('message.email')}}<span>*</span></label>
                <input type="text" name="email" id="email" value="{{old('email')}}">

                @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif

                @if (session('notification'))
                <p>{{ session('notification') }}</p>
                @endif

                <div>
                    <button type="submit">{{trans('message.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection