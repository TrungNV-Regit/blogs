@extends('layouts.master')

@section('title', __('message.list_blog'))

@section('content')

@section('class', 'header-static')
@php
    use App\Models\User;
    $user = $data['user'];
    $blogs = $data['blogs'];
@endphp

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <a href="{{ route('admin.user.index') }}">{{ __('message.list_user') }} &nbsp;>&nbsp; </a>
        <span>{{ $user->username }}</span>
    </div>
    <div class="my-profile mt-5">
        <div class="card">
            <div class="d-flex justify-content-center background-image">
                <img src="{{ $user->link_avatar }}" class="rounded-circle " alt="{{ $user->username }}">
            </div>
            <h1>
                {{ $user->username }}
            </h1>
            <p class="title">
                {{ $user->email }}
            </p>
            <p class="title">
                {{ __('message.blogs') }} : {{ $user->blogs->count() }}
            </p>
        </div>
    </div>
    <div class="content">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-12 col-lg-4 col-sm-12">
                    <a href="{{ route('admin.blog.show', ['id' => $blog->id]) }}">
                        @include('layouts.blog', ['blogs' => $blog])
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{ $blogs->withQueryString()->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
