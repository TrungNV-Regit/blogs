<div>
    @if (Auth::check())
    <p>List blog user: {{ Auth::user()->username }} </p>
    @include('layouts.logout')
    @endif
</div>
