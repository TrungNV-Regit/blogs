@extends('layouts.master')

@section('title', 'Verify Email')
@section('content')
    <div class="logo">
        <div>
            <a href="{{route('/home')}}">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
                <span>RT-Blogs</span>
            </a>
        </div>
    </div>
    
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
@endsection
