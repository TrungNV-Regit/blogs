@extends('layouts.master')

@section('title', __('message.detail'))

@section('content')

@section('class', 'header-static')

<div id="data" blog="{{ json_encode($blog) }}"></div>

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
                    <span class="create-at">{{ $blog->formatted_created_date }}</span>
                </div>
            </div>
            <div class="action">
                @if ($user && $user->id === $blog->author->id)
                    <button class="btn-warning"
                        onclick="window.location.href='{{ route('user.blog.edit', ['id' => $blog->id]) }}'">
                        {{ __('message.update_blog') }}
                    </button>
                    <button class="btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        {{ __('message.delete_blog') }}
                    </button>
                @endif
            </div>
        </div>
        @if ($blog->link_image)
            <img class="blog-image" src="{{ $blog->link_image }}" alt="{{ $blog->title }}">
        @endif
        <div class="blog-content">
            <p>{{ $blog->content }}</p>
            <div class="like-comment">
                @if ($user)
                    <div id="like" class="{{ $user->likes()->where('blog_id', $blog->id)->exists()? 'liked': 'unliked' }}"></div>
                @else
                    <div id="like" class="unliked"></div>
                @endif
                <span id="totalLike">{{ $blog->likes()->count() }}</span>
                <img src="{{ Vite::asset('resources/images/comment.png') }}" />
                <span>{{ $blog->comments()->count() }}</span>
            </div>
        </div>
    </div>

    @include('blogs.related')

    @include('blogs.comments')

</div>

@include ('layouts.modal')

@include('layouts.footer')

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

<script type="module" src="{{ Vite::asset('resources/js/ajax/like.js') }}"></script>

@endsection
