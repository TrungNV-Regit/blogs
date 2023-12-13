@extends('layouts.master')

@section('title', __('message.detail'))

@section('content')

@section('class', 'header-static')

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
            <div class="like">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                    <span>{{ $blog->likes()->count() }}</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-chat" viewBox="0 0 16 16">
                        <path
                            d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894m-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                    </svg>
                    <span>{{ $blog->comments()->count() }}</span>
                </div>
            </div>
        </div>

        @include('blogs.related')

        @include('blogs.comments')

    </div>
</div>

@include ('layouts.modal')

@include('layouts.footer')

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

@endsection
