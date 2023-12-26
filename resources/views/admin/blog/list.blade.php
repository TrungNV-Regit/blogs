@extends('layouts.master')

@section('title', __('message.list_blog'))

@section('content')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.list_blog') }}</span>
    </div>

    <div class="search-blog-admin">
        <form action="{{ route('admin.blog.index') }}" class="d-flex" method="GET">
            <select name="status">
                @foreach ($statuses as $key => $status)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            <select name="categoryId">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input type="text" placeholder="{{ __('message.search') }}" name="title" class="input-search "
                value={{ app('request')->input('title') }}>
            <button type="submit" class="btn btn-success">
                {{ __('message.search') }}
            </button>
        </form>
    </div>


    <div class="content">
        <div class="row">

            @if (count($data))
                @foreach ($data as $blog)
                    <div class="col-md-12 col-lg-4 col-sm-12">
                        <a href="{{ route('admin.blog.show', ['id' => $blog->id]) }}">
                            @include('layouts.blog', ['blogs' => $blog])
                        </a>
                    </div>
                @endforeach
            @else
                <h1 class='text-success'>{{ __('message.empty_list') }}</h1>
            @endif

        </div>
    </div>
</div>

{{ $data->withQueryString()->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
