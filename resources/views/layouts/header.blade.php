@php
    use App\Models\User;
    $keyword = app('request')->input('keyword');
@endphp

<div class="header @yield('noHeader')">
    <div class="header-mobile d-lg-none d-md-none d-sm-block" id="headerMobile">

        <form action="{{ route('index') }}" id="search" method="GET" class="{{ $keyword ? '' : 'd-none' }}">
            <input type="text" placeholder="{{ __('message.search') }}" id="inputSearch" name="keyword"
                value={{ $keyword }}>

            <input class="d-none" value="{{ app('request')->input('category') }}" name="category" id="categoryId">

            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.13101 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4764 19 18.2964 19C18.1173 19 17.9373 18.9331 17.7994 18.7992L14.8286 15.902C13.2659 17.126 11.2844 17.8587 9.13101 17.8587C4.09613 17.8587 -0.000213623 13.8527 -0.000213623 8.9289C-0.000213623 4.00508 4.09613 0 9.13101 0ZM9.13101 1.37537C4.87152 1.37537 1.40618 4.76336 1.40618 8.9289C1.40618 13.0944 4.87152 16.4833 9.13101 16.4833C13.3896 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3896 1.37537 9.13101 1.37537Z"
                        fill="#A7A7A7" />
                </svg>
            </button>
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-x-lg"
                viewBox="0 0 16 16" class="cancelSearch" onclick="handleCancelSearch()">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </form>

        <div class="{{ $keyword ? 'd-none' : '' }}">
            <div class="menu dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="37" viewBox="0 0 35 37" fill="none"
                    class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <path d="M4.375 10.7917H30.625" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M4.375 18.5H30.625" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M4.375 26.2083H30.625" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                @if (Auth::check())
                    @include('layouts.dropdown_menu')
                @endif
            </div>
            <div class="logo-mobile">
                <a href="{{ route('index') }}">
                    <img src="{{ Vite::asset('resources/images/logo-mobile.png') }}" alt="Logo Mobile">
                    <span>{{ __('message.made') }}</span>
                </a>
            </div>
            <div class="logo-search-mobile" onclick="seachMobile()">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.13098 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4763 19 18.2963 19C18.1172 19 17.9372 18.9331 17.7994 18.7992L14.8286 15.902C13.2658 17.126 11.2843 17.8587 9.13098 17.8587C4.0961 17.8587 -0.000244141 13.8527 -0.000244141 8.9289C-0.000244141 4.00508 4.0961 0 9.13098 0ZM9.13098 1.37537C4.87149 1.37537 1.40615 4.76336 1.40615 8.9289C1.40615 13.0944 4.87149 16.4833 9.13098 16.4833C13.3895 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3895 1.37537 9.13098 1.37537Z"
                        fill="#A7A7A7" />
                </svg>
            </div>
        </div>

    </div>

    <div class="nav d-lg-block d-md-block d-sm-none @yield('class')" id="headerScroll">
        <div class="nav-logo">
            <a href="{{ route('index') }}">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" />
                <span>{{ __('message.made') }}</span>
            </a>
        </div>

        <form action="{{ route('index') }}" id="search" method="GET">

            <input type="text" placeholder="{{ __('message.search') }}" id="inputSearch" name="keyword"
                value={{ app('request')->input('keyword') }}>

            <input class="d-none" value="{{ app('request')->input('category') }}" name="category" id="categoryId">

            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.13101 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4764 19 18.2964 19C18.1173 19 17.9373 18.9331 17.7994 18.7992L14.8286 15.902C13.2659 17.126 11.2844 17.8587 9.13101 17.8587C4.09613 17.8587 -0.000213623 13.8527 -0.000213623 8.9289C-0.000213623 4.00508 4.09613 0 9.13101 0ZM9.13101 1.37537C4.87152 1.37537 1.40618 4.76336 1.40618 8.9289C1.40618 13.0944 4.87152 16.4833 9.13101 16.4833C13.3896 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3896 1.37537 9.13101 1.37537Z"
                        fill="#A7A7A7" />
                </svg>
            </button>
        </form>

        <a href="{{ route('index') }}" class="top-blog @yield('backgroundTopBlog')">
            <span>{{ __('message.top') }}</span>
        </a>

        @if (Auth::check())
            @if (Auth::user()->role == User::ROLE_USER)
                <a href="{{ route('user.blog.create') }}" class="create-blog @yield('backgroundCreateBlog')">
                    <span>{{ __('message.create') }}</span>
                </a>
            @endif
            <div class="profile">
                <span>{{ Auth::user()->username }}</span>
                <div class="dropdown">
                    <img src="{{ Auth::user()->link_avatar }}" alt="Avatar" class="dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    @include('layouts.dropdown_menu')
                </div>
            </div>
        @else
            <div class='no-login'>
                <a href="{{ route('auth.sign-in') }}">
                    <span>{{ trans('message.login') }}</span>
                </a>
                <a href="{{ route('auth.sign-up') }}">
                    <span>{{ trans('message.sign_up') }}</span>
                </a>
            </div>
        @endif
    </div>

    @yield('banner')

</div>
