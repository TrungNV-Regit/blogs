@extends('layouts.master')

@section('title', __('message.title_blog_detail'))

@section('content')

    @extends('layouts.header')

@section('class', 'header-static')

@php
    use App\Models\User;
    use App\Models\Blog;
@endphp

<div class="page-approve-blog">
    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.detail') }}</span> </a>
    </div>
    <div class="content">
        <h3>{{ $blog->title }}</h3>
        <div class="author-action">
            <div class="author">
                <img class="author-image" src="{{ $blog->author->link_avatar }}" alt="Image author">
                <div class="detail">
                    <span class="author-name">{{ $blog->author->username }}</span>
                    <span class="create-at">{{ $blog->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="action">
                @if ($user)
                    @if ($user->role === User::ROLE_ADMIN)
                        @if ($blog->status == Blog::STATUS_PENDING)
                            <form action="{{ route('blog.change-status', ['id' => $blog->id]) }}" method="post"
                                class="d-none" id="approved">
                                @csrf
                                @method('POST')
                            </form>
                            <button class="btn-success" onclick="document.getElementById('approved').submit();">
                                {{ __('message.approved') }}
                            </button>
                        @else
                            <form action="{{ route('blog.change-status', ['id' => $blog->id]) }}" method="post"
                                class="d-none" id="unapproved">
                                @csrf
                                @method('POST')
                            </form>
                            <button class="btn-success" onclick="document.getElementById('unapproved').submit();">
                                {{ __('message.unapproved') }}
                            </button>
                        @endif
                        <button class="btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">{{ __('message.delete_blog') }}</button>
                    @endif
                    @if ($user->id === $blog->author->id)
                        <button class="btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">{{ __('message.delete_blog') }}</button>
                    @endif
                @endif
            </div>
        </div>
        @if ($blog->link_image)
            <img class="blog-image" src="{{ $blog->link_image }}" alt="Image blog">
        @endif
        <div class="blog-content">
            <p>{{ $blog->content }}</p>
        </div>
        <div class="blog-comment">

            <div class='title-comment'>
                <h6>{{ __('message.comment') }}</h6>
            </div>
            <div class='title-comment'>
                <hr>
            </div>

            <div class="comment">
                @if ($user)
                    <div class="my-comment">
                        <img class="comment-image-author" src="{{ $user->link_avatar }}" alt="My avatar">
                        <form action="" method="post">
                            <input type="text">
                        </form>
                    </div>
                @endif
                <div class="list-comment">
                    @foreach ($blog->comments as $comment)
                        <div class="single-comment">
                            <div class="author">
                                <img class="comment-image-author" src="{{ $blog->author->link_avatar }}"
                                    alt="">
                                <span>{{ $comment->author->username }}</span>
                            </div>
                            <div class="comment-detail">
                                <p class="color-comment">{{ $comment->content }}</p>
                                <p class="color-time">{{ $comment->create_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include ('layouts.modal')

@include('layouts.footer')

@endsection
