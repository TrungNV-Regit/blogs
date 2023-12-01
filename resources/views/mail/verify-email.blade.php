@extends('layouts.master')

@section('title', 'Verify Email')
@section('content')
<div>
	<a href="{{route('auth.verify-email').'?token='.$content }}">Verify</a>
	<p>Hello,</p>
	<p>This is a verify mail</p>
	<strong>Thanks.</strong>
</div>
@endsection