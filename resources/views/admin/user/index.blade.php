@extends('layouts.master')

@section('title', __('message.list_user'))

@section('content')

@section('class', 'header-static')

@php
    use App\Models\User;
@endphp

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.list_user') }}</span>
    </div>
    <div class="search-user">
        <form action="{{ route('admin.user.index') }}" method="GET" class="d-flex">
            <input type="text" name="username" value="{{ request('username') }}"
                placeholder="{{ __('message.search_user') }}" required>
            <button type="submit" class="btn btn-success">{{ __('message.submit') }}</button>
        </form>
    </div>

    <table class="table table-hover table-bordered table-manager-user">
        <thead>
            <tr class="text-center">
                <th>{{ __('message.no') }}</th>
                <th>{{ __('message.avatar') }}</th>
                <th>{{ __('message.username') }}</th>
                <th>{{ __('message.email') }}</th>
                <th>
                    {{ __('message.blogs') }}
                    <a href="{{ route('admin.user.index', ['sortTotalBlog' => 'DESC']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                        </svg>
                    </a>
                    <a href="{{ route('admin.user.index', ['sortTotalBlog' => 'ASC']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                            class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                        </svg>
                    </a>
                </th>
                <th>{{ __('message.status') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (count($users))
                @foreach ($users as $index => $user)
                    <tr class="text-center">
                        <td class="align-middle text-center col-1">
                            {{ $index + 1 }}
                        </td>
                        <td class="align-middle text-center col-2">
                            <img src="{{ $user->link_avatar }}" class="rounded-circle" alt="profile image">
                        </td>
                        <td class="align-middle text-center col-2">
                            <a href="{{ route('admin.user.detail', ['userId' => $user->id]) }}">
                                <p>{{ $user->username }}</p>
                            </a>
                        </td>
                        <td class="align-middle text-center col-3">
                            <p>{{ $user->email }}</p>
                        </td>
                        <td class="align-middle text-center col-2">
                            <p>{{ $user->blogs->count() }}</p>
                        </td>
                        <td class="align-middle text-center col-2">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input w-50" type="checkbox"
                                    {{ $user->status == User::STATUS_ACTIVE ? 'checked' : '' }}
                                    change-status-route={{ route('admin.user.change-status', ['userId' => $user->id]) }}>
                            </div>
                            <p class="status">
                                {{ $user->status == User::STATUS_ACTIVE ? __('message.active') : __('message.blocked') }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan='6' class="align-middle text-center">
                        <p>
                            {{ __('message.no_result') }}
                        </p>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</div>

{{ $users->withQueryString()->links('layouts.pagination') }}

@include('layouts.footer')

@endsection

<script type="module" src="{{ Vite::asset('resources/js/ajax/app.js') }}"></script>
