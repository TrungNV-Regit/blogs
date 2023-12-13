@extends('layouts.master')

@section('title', trans('message.verify_email'))

@section('content')

    @include('layouts.logo')

    <p>Hello,</p>
    <p>This is a verify mail</p>
    <a href="{{ route('auth.verify-email') . '?token=' . $content }}">Verify</a>
    <br />
    <strong>Thanks.</strong>

@endsection
