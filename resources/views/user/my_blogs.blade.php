<div>
    @if (Auth::check())
    <p>List blog user: {{ session('user')->username }} </p>
    @include('layouts.logout')
    @endif
</div>