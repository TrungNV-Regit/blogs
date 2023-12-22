@extends('layouts.master')

@section('title', __('message.category_management'))

@section('content')

@section('class', 'header-static')

@php
    $update = app('request')->input('id');
@endphp

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.category_management') }}</span>
    </div>
    <div class="content">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategory"
            {{ $update ? 'disabled' : '' }}>
            {{ __('message.create_category') }}
        </button>

        <table class="table table-hover table-bordered table-manager-user list-category">
            <thead>
                <tr class="text-center">
                    <th>
                        {{ __('message.no') }}
                    </th>
                    <th>
                        {{ __('message.name_category') }}
                    </th>
                    <th class="d-flex align-items-center justify-content-center">
                        {{ __('message.blogs') }}
                        <a href="{{ route('admin.category.index', ['order' => 'DESC']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                            </svg>
                        </a>
                        <a href="{{ route('admin.category.index', ['order' => 'ASC']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                class="bi bi-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                            </svg>
                        </a>
                    </th>
                    <th>{{ __('message.action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $index => $category)
                    <tr class="text-center" id="{{ $category->id }}">
                        <td class="align-middle text-center col-2">
                            <span>
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="align-middle text-center col-5 name-category">
                            @if (app('request')->input('id') == $category->id)
                                <form action="{{ route('admin.category.update') }}" method="POST"
                                    class="update-category">

                                    @csrf
                                    @method('PUT')

                                    <div class="d-flex align-items-center action-update">
                                        <input name="name" placeholder="{{ __('message.name_category') }}"
                                            value="{{ $errors->has('name') ? old('name') : $category['name'] }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="red"
                                            width="20" height="20" viewBox="0 0 50 50" class="cancel-update"
                                            data-href="{{ route('admin.category.index') }}">
                                            <path
                                                d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 37.690466 12.309534 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 13.390466 46 4 36.609534 4 25 C 4 13.390466 13.390466 4 25 4 z M 32.990234 15.986328 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.990234 15.986328 z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="green"
                                            width="20" height="20" viewBox="0 0 50 50" class="comfirm-update">
                                            <path
                                                d="M 20 4 C 15.054688 4 11 8.054688 11 13 L 11 35.5625 L 5.71875 30.28125 L 4.28125 31.71875 L 11.28125 38.71875 L 12 39.40625 L 12.71875 38.71875 L 19.71875 31.71875 L 18.28125 30.28125 L 13 35.5625 L 13 13 C 13 9.144531 16.144531 6 20 6 L 31 6 L 31 4 Z M 38 10.59375 L 37.28125 11.28125 L 30.28125 18.28125 L 31.71875 19.71875 L 37 14.4375 L 37 37 C 37 40.855469 33.855469 44 30 44 L 19 44 L 19 46 L 30 46 C 34.945313 46 39 41.945313 39 37 L 39 14.4375 L 44.28125 19.71875 L 45.71875 18.28125 L 38.71875 11.28125 Z">
                                            </path>
                                        </svg>
                                    </div>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif

                                    <input name="id" value="{{ $category->id }}" type="hidden">

                                </form>
                            @else
                                <span>
                                    {{ $category->name }}
                                </span>
                            @endif
                        </td>
                        <td class="align-middle text-center col-2">
                            <span>
                                {{ $category->blogs()->count() }}
                            </span>
                        </td>
                        <td class="align-middle text-center col-3">
                            <a href="{{ route('admin.category.edit') }}?{{ http_build_query(array_merge(request()->query(), ['id' => $category->id])) }}#{{ $category->id }}"
                                class="{{ $update ? 'btn disabled' : '' }}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#27ae60"
                                    xmlns="http://www.w3.org/2000/svg" class="update-category cursor-pointer">
                                    <path
                                        d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 17.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4963 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0202 4.37001 21.0202 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                            @if (!$category->blogs->count())
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                    class="bi bi-trash {{ $update ? '' : 'destroy-category cursor-pointer' }}"
                                    viewBox="0 0 16 16" data-id="{{ $category->id }}">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->withQueryString()->links('layouts.pagination') }}

    </div>
    <div class="modal fade" id="createCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('message.create_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.store') }}" method="POST" class="create-category">

                        @csrf
                        @method('POST')

                        <label for="name">{{ __('message.name_category') }} : </label>
                        <input name="name" id="name" placeholder="{{ __('message.name_category') }}"
                            value="{{ old('name') }}">

                        @if ($errors->any() && !app('request')->input('id'))
                            <p class="text-danger">{{ $errors->first('name') }}
                        @endif

                        <input type="submit" value="{{ __('message.submit') }}">

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('message.delete') }}</h5>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13"
                        fill="none" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.5595 0.4395L6.2945 4.1743L10.0275 0.4437C10.6135 -0.1423 11.5615 -0.1423 12.1475 0.4437C12.7335 1.0297 12.7335 1.9777 12.1475 2.5637L8.4145 6.2943L12.1515 10.0335C12.7375 10.6195 12.7375 11.5675 12.1515 12.1535C11.8595 12.4475 11.4735 12.5935 11.0915 12.5935C10.7075 12.5935 10.3235 12.4475 10.0315 12.1535L6.2945 8.4143L2.5635 12.1477C2.2715 12.4417 1.8875 12.5877 1.5035 12.5877C1.1195 12.5877 0.735501 12.4417 0.443501 12.1477C-0.142499 11.5617 -0.142499 10.6137 0.443501 10.0277L4.1745 6.2943L0.4395 2.5595C-0.1465 1.9735 -0.1465 1.0255 0.4395 0.4395C1.0275 -0.1465 1.9755 -0.1465 2.5595 0.4395Z"
                            fill="#6C6C6C" />
                    </svg>
                </div>
                <div class="modal-body confirm-delete">
                    {{ __('message.comfirm_delete_category') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('message.cancel') }}
                    </button>
                    <form action="{{ route('admin.category.destroy') }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="id">

                        <button type="submit" class="btn btn-danger">
                            {{ __('message.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any() && !$update)
    <script>
        $(function() {
            $('#createCategory').modal('show');
        });
    </script>
@endif

@include('layouts.footer')

@endsection
