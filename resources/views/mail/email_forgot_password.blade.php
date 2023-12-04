@extends('layouts.master')

@section('title', 'Forgot Password')

@section('content')

@include('layouts.logo')
<h2>Hello, this is your new password : {{$content}}</h2>
<a href="{{route('auth.sign-in')}}">Login</a>
<br />
<strong>Thanks.</strong>
@endsection