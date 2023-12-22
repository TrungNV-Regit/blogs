@extends('layouts.master')

@section('title', __('message.list_blog'))

@section('content')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.list_blog') }}</span>
    </div>
    <div>
        <select onchange="window.location.href = this.value;">
            @foreach ($statuses as $key => $status)
                <option value="{{ route('admin.blog.index', ['status' => $key]) }}"
                    {{ request('status') == $key ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
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
