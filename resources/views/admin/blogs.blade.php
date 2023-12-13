@extends('layouts.master')

@section('title', __('message.title_management_blog'))

@section('content')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.list_blog') }}</span> </a>
    </div>
    <div>
        <select onchange="window.location.href = this.value;">
            @foreach ($statuses as $key => $status)
                <option value="{{ route('blog.index', ['status' => $key]) }}"
                    {{ request('status') == $key ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    @include('layouts.list_blog', ['blogs' => $data])

</div>

{{ $data->links('layouts.pagination') }}

@include('layouts.footer')

@endsection
