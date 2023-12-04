<div>
    @if (Auth::check())
        <p>Xin chào, user {{ Auth::user()->username }}</p>
        @include('layouts.logout')
    @else
        <h3><a href="{{ route('auth.sign-in') }}">Sign In</a></h3>
    @endif
</div>