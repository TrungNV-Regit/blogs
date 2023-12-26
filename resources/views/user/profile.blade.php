@extends('layouts.master')

@section('title', __('message.profile'))

@section('content')

@section('class', 'header-static')

<div class="blogs">
    <div class='breadcrumb'>
        <a href="{{ route('index') }}">{{ __('message.home') }} &nbsp;>&nbsp; </a>
        <span>{{ __('message.profile') }}</span>
    </div>
    <div class="my-profile mt-5">
        <div class="card">
            <div class="d-flex justify-content-center background-image">
                <img src="{{ $user->link_avatar }}" class="rounded-circle " alt="{{ $user->username }}">
            </div>
            <h1>
                {{ $user->username }}
            </h1>
            <p class="title">
                {{ $user->email }}
            </p>
            <p class="title">
                {{ __('message.blogs') }} : {{ $user->blogs->count() }}
            </p>
            <button data-bs-toggle="modal" data-bs-target="#updateProfile"class="update">
                {{ __('message.update') }}
            </button>
        </div>
    </div>
    <div class="modal fade" id="updateProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('message.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.profile.update', $user) }}" enctype="multipart/form-data"
                        method="POST" class="update-profile">

                        @csrf
                        @method('PUT')

                        <label for="uploadImage">{{ __('message.upload_avatar') }}</label>
                        <input name='image' id="uploadImage" class="upload-image d-none" type="file"
                            accept="image/png, image/jpeg" />
                        <img id='imageBlog' class="d-none">

                        @if ($errors->has('image'))
                            <p>{{ $errors->first('image') }}</p>
                        @endif

                        <button class='btn btn-warning d-none mb-2' id="buttonDeleteImage" type="button"
                            onclick="deleteImage(true)">
                            {{ __('message.delete') }}
                        </button>

                        <label>{{ __('message.new_username') }}</label>
                        <input type="text" class="update-username" name="username"
                            placeholder="{{ __('message.new_username') }}" value="{{ old('username') }}">

                        @if ($errors->has('username'))
                            <p class="text-danger">{{ $errors->first('username') }}</p>
                        @endif

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('message.update') }}
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                {{ __('message.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        $(function() {
            $('#updateProfile').modal('show');
        });
    </script>
@endif

@include('layouts.footer')

@endsection
