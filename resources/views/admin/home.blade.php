<div>
    @if (Auth::check())
    <p>Xin chào, Admin {{ session('user')->username }}</p>
    @include('layouts.logout')
    @endif
</div>