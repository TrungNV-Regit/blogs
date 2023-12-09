<div>
    @if (Auth::check())
        <p>List blog user: {{ Auth::user()->username }} </p>
    @endif
</div>
