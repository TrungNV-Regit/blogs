@extends('layouts.master')

@section('title', __('message.update_blog'))

@section('content')

    @extends('layouts.header')

@section('class', 'header-static')

<div class="page-create-blog">

    <div class='breadcrumb'>
        <a href="{{ route('/') }}">{{ __('message.home') }} > <span>{{ __('message.update_blog') }}</span> </a>
    </div>
    <div class='content'>

        <div>
            <form action="{{ route('blog.update', ['id' => $blog->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <h3>{{ __('message.update_blog') }}</h3>

                <p>{{ __('message.category') }} <span>*</span></p>
                <select name="category_id" class="category">
                    <option disabled selected>{{ __('message.select_category') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                            {{ $category['id'] == $blog->category->id ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('category_id'))
                    <p class="error">{{ $errors->first('category_id') }}</p>
                @endif

                <p>{{ __('message.title') }} <span>*</span></p>
                <input type="text" name='title' value="{{ $blog->title }}">

                @if ($errors->has('title'))
                    <p class="error">{{ $errors->first('title') }}</p>
                @endif

                <p>{{ __('message.upload_image') }}</p>
                <label for="uploadImage">{{ __('message.upload_image') }}</label>
                <input name='image' id="uploadImage" class="upload-image" type="file"
                    accept="image/png, image/jpeg" />
                <input type="checkbox" class="d-none" name="checkDeleteImage" id="checkDeleteImage" />

                <img id='imageBlog' class="{{ $blog->link_image ? '' : 'd-none' }}" src="{{ $blog->link_image }}">
                <button class='btn-success {{ $blog->link_image ? '' : 'd-none' }}' id="buttonDeleteImage"
                    type="button" onclick="deleteImage({{ $blog->link_image ? true : false }})">
                    {{ __('message.delete_image') }}
                </button>

                <p>{{ __('message.description') }} <span>*</span></p>
                <textarea name='content'>{{ $blog->content }}</textarea>

                @if ($errors->has('content'))
                    <p class="error">{{ $errors->first('content') }}</p>
                @endif

                <button type="submit">{{ __('message.submit') }}</button>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

@endsection
