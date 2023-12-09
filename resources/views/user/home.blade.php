@extends('layouts.master')

@section('title', 'RT Blog Home')

@section('content')

    @extends('layouts.header')

@section('banner')
    <img src="{{ Vite::asset('resources/images/banner.png') }}" class="image-banner" alt="Image banner">
@endsection

@section('backgroundTopBlog', 'background')

@endsection
