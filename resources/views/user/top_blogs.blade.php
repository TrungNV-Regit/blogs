@extends('layouts.master')

@section('title', __('message.top_blog'))

@section('content')

@section('class', 'header-static')

@section('backgroundTopBlog', 'background')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.top_blog') }}</span>
    </div>
    <div class="content">
        <div class="row">
            @if (count($blogs))
                @foreach ($blogs as $blog)
                    <div class="col-md-12 col-lg-4 col-sm-12">
                        <a href="{{ route('blog.show', ['id' => $blog->id]) }}">
                            @include('layouts.blog', ['blogs' => $blog, 'topBlog' => true])
                        </a>
                    </div>
                @endforeach
            @else
                <h1 class='text-success'>{{ __('message.empty_list') }}</h1>
            @endif
        </div>
    </div>
</div>

{{ $blogs->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
