@extends('layouts.master')

@section('title', __('message.home'))

@section('content')

@section('banner')
    <img src="{{ Vite::asset('resources/images/banner.png') }}" class="image-banner" alt="Image banner">
@endsection

@section('backgroundTopBlog', 'background')

<div class="blogs">
    <div class="header-body">
        <h1 class="title-body">{{ __('message.list_blog') }}</h1>
        <select name="category" onchange="handleOnchangeCategory(value)">
            <option disabled selected>{{ __('message.category') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" {{ request('category') == $category['id'] ? 'selected' : '' }}>
                    {{ $category['name'] }}
                </option>
                {{ $category['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="row">
        @if (count($data))
            @foreach ($data as $blog)
                <div class="col-md-12 col-lg-4 col-sm-12">
                    <a href="{{ route('blog.show', ['id' => $blog->id]) }}">
                        @include('layouts.blog', ['blog' => $blog])
                    </a>
                </div>
            @endforeach
        @else
            <h1 class='text-info'>{{ __('message.empty_list') }}</h1>
        @endif

    </div>
</div>

{{ $data->withQueryString()->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
