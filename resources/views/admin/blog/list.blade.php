@extends('layouts.master')

@section('title', __('message.list_blog'))

@section('content')

    @extends('layouts.header')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.list_blog') }}</span> </a>
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
            @if (count($data) == 0)
                <h1 class='text-success'>{{ __('message.empty_list') }}</h1>
            @endif
            @foreach ($data as $blog)
                <div class="col-md-6 col-lg-4 col-sm-12 col-sx-12">
                    <a href="{{ route('admin.blog.show', ['id' => $blog->id]) }}">
                        @include('layouts.blog', ['blogs' => $blog])
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{ $data->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
