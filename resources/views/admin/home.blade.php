<div>
    @if (Auth::check())
    <p>Admin {{ Auth::user()->username }}</p>
    @include('layouts.logout')
    @endif
</div>
