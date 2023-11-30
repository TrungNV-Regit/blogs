@if (session('success'))
<div class='notification'>
    <span> {{ session('success') }}</span>
</div>
@endif

@if (session('blocked'))
<div class='notification error'>
    <span> {{ session('blocked') }}</span>
</div>
@endif

@if (session('notVerified'))
<div class='notification error'>
    <span> {{ session('notVerified') }}</span>
</div>
@endif
