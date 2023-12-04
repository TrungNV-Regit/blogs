<div>
    @if (Auth::check())
    <p>Admin {{ session('user')->username }}</p>
    @include('layouts.logout')
    @endif
</div>
