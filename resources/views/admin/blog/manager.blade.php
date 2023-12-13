@extends('layouts.master')

@section('title', __('message.title_management_blog'))

@section('content')

@section('class', 'header-static')

@php
    use App\Models\Blog;
@endphp

<div class="page-approve-blog">
    <div class='breadcrumb'>
        <a href="{{ route('/index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.detail') }}</span>
    </div>
    <div class="content">
        <h3>{{ $blog->title }}</h3>
        <div class="author-action">
            <div class="author">
                <img class="author-image" src="{{ $blog->author->link_avatar }}" alt="{{ $blog->author->username }}">
                <div class="detail">
                    <span class="author-name">{{ $blog->author->username }}</span>
                    <span class="create-at">{{ $blog->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="action">
                <form action="{{ route('admin.blog.change-status', ['id' => $blog->id]) }}" method="post"
                    class="d-none" id="changeStatus">
                    @csrf
                    @method('POST')
                </form>
                <button class="btn {{ $blog->status == Blog::STATUS_PENDING ? 'btn-approved' : 'btn-not-approved' }}"
                    onclick="document.getElementById('changeStatus').submit();">
                    {{ $blog->status == Blog::STATUS_PENDING ? __('message.approved') : __('message.not_approved') }}
                </button>
                <button class="btn-warning"
                    onclick="window.location.href='{{ route('admin.blog.edit', ['id' => $blog->id]) }}'">
                    {{ __('message.update_blog') }}
                </button>
                <button class="btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    {{ __('message.delete_blog') }}
                </button>
            </div>
        </div>
        @if ($blog->link_image)
            <img class="blog-image" src="{{ $blog->link_image }}" alt="{{ $blog->author->username }}">
        @endif
        <div class="blog-content">
            <p>{{ $blog->content }}</p>
        </div>

        @include('blogs.comments')

    </div>
</div>

@include ('layouts.modal')

@include('layouts.footer')

@endsection
