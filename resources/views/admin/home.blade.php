<div>
    @if (Auth::check())
    <p>Admin {{ Auth::user()->username }}</p>
    @endif
</div>
