@extends('layouts.master')

@section('title', __('message.list_user'))

@section('content')

@section('class', 'header-static')

@php
    use App\Models\User;
@endphp

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('/index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.list_user') }}</span>
    </div>
    <div class="search-user">
        <form action="{{ route('admin.user.index') }}" method="GET" class="d-flex">
            <input type="text" name="username" placeholder="{{ __('message.search_user') }}" required>
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
                <th>{{ __('message.blogs') }}</th>
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
                            <p>{{ $user->username }}</p>
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
