@extends('layouts.master')

@section('title', 'TR Blog Admin Approve')

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
        <h3>{{ $blog['title'] }}</h3>
        <div class="author-action">
            <div class="author">
                <img class="author-image" src="{{ $blog->author->link_avatar }}" alt="Image author">
                <div class="detail">
                    <span class="author-name">{{ $blog->author->username }}</span>
                    <span class="create-at">{{ $blog['created_at']->format('d/m/Y') }}</span>
                </div>
            </div>
            <div class="action">
                @if (Auth::check())
                    @if (Auth::user()->role === User::ROLE_ADMIN)
                        @if ($blog['status'] == Blog::STATUS_PENDING)
                            <form action="{{ route('blog.aprrove', ['id' => $blog['id']]) }}" method="post"
                                class="d-none" id="approvedForm">
                                @csrf
                                @method('POST')
                            </form>
                            <button class="btn-success" onclick="document.getElementById('approvedForm').submit();">
                                {{ __('message.approved') }}
                            </button>
                        @endif
                        <button class="btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">{{ __('message.delete_blog') }}</button>
                    @endif
                    @if (Auth::user()->id === $blog->author->id)
                        <button class="btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">{{ __('message.delete_blog') }}</button>
                    @endif
                @endif
            </div>
        </div>
        @if ($blog['link_image'])
            <img class="blog-image" src="{{ $blog['link_image'] }}" alt="Image blog">
        @endif
        <div class="blog-content">
            <p>{{ $blog['content'] }}</p>
        </div>
        <div class="blog-comment">

            <div class='title-comment'>
                <h6>{{ __('message.comment') }}</h6>
            </div>
            <div class='title-comment'>
                <hr>
            </div>

            <div class="comment">
                @if (Auth::check())
                    <div class="my-comment">
                        <img class="comment-image-author" src="{{ Auth::user()->link_avatar }}" alt="My avatar">
                        <form action="" method="post">
                            <input type="text">
                        </form>
                    </div>
                @endif
                <div class="list-comment">
                    @foreach ($blog['comments'] as $comment)
                        <div class="single-comment">
                            <div class="author">
                                <img class="comment-image-author" src="{{ $blog->author->link_avatar }}"
                                    alt="">
                                <span>{{ $comment['author']['username'] }}</span>
                            </div>
                            <div class="comment-detail">
                                <p class="content">{{ $comment['content'] }}</p>
                                <p class="time">{{ $comment['create_at']->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('message.delete') }}</h5>
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none"
                    class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.5595 0.4395L6.2945 4.1743L10.0275 0.4437C10.6135 -0.1423 11.5615 -0.1423 12.1475 0.4437C12.7335 1.0297 12.7335 1.9777 12.1475 2.5637L8.4145 6.2943L12.1515 10.0335C12.7375 10.6195 12.7375 11.5675 12.1515 12.1535C11.8595 12.4475 11.4735 12.5935 11.0915 12.5935C10.7075 12.5935 10.3235 12.4475 10.0315 12.1535L6.2945 8.4143L2.5635 12.1477C2.2715 12.4417 1.8875 12.5877 1.5035 12.5877C1.1195 12.5877 0.735501 12.4417 0.443501 12.1477C-0.142499 11.5617 -0.142499 10.6137 0.443501 10.0277L4.1745 6.2943L0.4395 2.5595C-0.1465 1.9735 -0.1465 1.0255 0.4395 0.4395C1.0275 -0.1465 1.9755 -0.1465 2.5595 0.4395Z"
                        fill="#6C6C6C" />
                </svg>
            </div>
            <div class="modal-body confirm-delete">
                {{ __('message.comfirm_delete_blog') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('message.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    onclick="document.getElementById('deleteBlogForm').submit();">{{ __('message.delete') }}</button>
                <form action="" method="post" class="d-none" id="deleteBlogForm">
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
