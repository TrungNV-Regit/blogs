@extends('layouts.master')

@section('title', 'Verify Email')

@section('content')

@include('layouts.logo')
<p>Hello,</p>
<p>This is a verify mail</p>
<a href="{{route('auth.verify-email').'?token='.$content }}">Verify</a>
<strong>Thanks.</strong>
@endsection
