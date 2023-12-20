@extends('layouts.master')

@section('title', trans('message.reset_password'))

@section('noHeader', 'd-none')

@section('content')

    <div class="verify">
        <div>

            @include('layouts.logo')

            <div class="content">
                <form action="{{ route('user.reset-password') }}" method="POST">
                    @csrf

                    <h4>{{ trans('message.reset_password') }}</h4>

                    <label for="oldPassword">
                        {{ trans('message.old_password') }}
                        <span>*</span>
                    </label>
                    <input type="password" id='oldPassword' name="oldPassword">

                    @if ($errors->has('oldPassword'))
                        <p>{{ $errors->first('oldPassword') }}</p>
                    @endif

                    <label for="password">
                        {{ trans('message.new_password') }}
                        <span>*</span>
                    </label>
                    <input type="password" id='password' name="password">

                    @if ($errors->has('password'))
                        <p>{{ $errors->first('password') }}</p>
                    @endif

                    <label for="passwordConfirmation">
                        {{ trans('message.new_password_confirmation') }}
                        <span>*</span>
                    </label>
                    <input type="password" name="password_confirmation" id='passwordConfirmation'>

                    @if ($errors->has('password'))
                        <p>{{ $errors->first('password') }}</p>
                    @endif

                    <div>
                        <button type="submit">{{ trans('message.submit') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
