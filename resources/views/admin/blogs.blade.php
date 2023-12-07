@extends('layouts.master')

@section('title', 'RT Blog Blog Management')

@section('content')

    @extends('layouts.header')

@section('class', 'header-static')

@php
    use App\Models\User;
    use App\Models\Blog;
@endphp

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.list_blog') }}</span> </a>
    </div>
    <div class="d-flex">
        <p>{{ __('message.choose_blog_type') }}</p>
        <select  onchange="window.location.href = this.value;">
            <option disabled > {{ __('message.choose_blog_type') }}</option>
            <option value="{{ route('blog.index', ['status' => Blog::STATUS_ACTIVE]) }}" {{request('status')==Blog::STATUS_ACTIVE ? 'selected': ''}}>
                {{ __('message.active') }}
            </option>
            <option value="{{ route('blog.index', ['status' => Blog::STATUS_PENDING]) }}"  {{request('status')==Blog::STATUS_PENDING ? 'selected': ''}}>
                {{ __('message.pending') }}
            </option>
        </select>
        <h4 class='mt-md-10 text-danger'>{{ __('message.choose_blog_type') }}</h4>
    </div>

    @include('layouts.list_blog', ['blogs' => $data])
</div>

{{ $data->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
