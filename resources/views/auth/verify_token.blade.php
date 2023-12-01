@extends('layouts.master')

@section('title', 'Verify Email')

@section('content')
<div class='verify'>
    <div>
        @include('layouts.logo')

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

            @if (isset($data['token_out_time']))
            <div class="success">
                <p>{{ $data['token_out_time'] }}</p>
                <a href="{{route('auth.resend-token').'?token='.$data['token']}}">Resend token</a>
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