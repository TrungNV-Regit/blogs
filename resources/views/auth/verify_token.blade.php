@extends('layouts.master')

@section('title', trans('messages.verify_email'))

@section('noHeader', 'd-none')

@section('content')
    <div class='verify'>
        <div>
            @include('layouts.logo')

            <div class='verify-token'>

                @if (isset($data['success']))
                    <div class="success">
                        <p>{{ $data['success'] }}</p>
                        <a href="{{ route('auth.sign-in') }}">{{ trans('message.login') }}</a>
                    </div>
                @endif

                @if (isset($data['error']))
                    <div class="error">
                        <p>{{ $data['error'] }}</p>
                    </div>
                @endif

                @if (isset($data['token_out_time']))
                    <div class="error">
                        <p>{{ $data['token_out_time'] }}</p>
                        <a
                            href="{{ route('auth.resend-token') . '?token=' . $data['token'] }}">{{ trans('message.resend_token') }}</a>
                    </div>
                @endif

                @if (isset($data['resend_token_success']))
                    <div class="success">
                        <p>{{ $data['resend_token_success'] }}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
