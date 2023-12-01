@extends('layouts.master')

@section('title', 'Verify Email')

@section('content')

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

</div>
@endsection
