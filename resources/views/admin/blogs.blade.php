@extends('layouts.master')

@section('title', 'RT Blog Blog Management')

@section('content')

    @extends('layouts.header')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.list_blog') }}</span> </a>
    </div>
    <div>
        <select name="type">
            <option disabled selected>Chosse type blog</option>
            <option value="1">ACTIVE</option>
            <option value="2">PENDING</option>
        </select>
    </div>
    @include('layouts.list_blog', ['blogs' => $data['blogs']])
</div>

@include('layouts.pagination', ['totalPages' => $data['totalPages']])

@include('layouts.footer')

@endsection
