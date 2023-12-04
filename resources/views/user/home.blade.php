<div>
    @if (session()->has('user'))
    <p>Xin chào, {{ session('user')->username }}</p>
    @else
    <h3><a href="{{route('auth.sign-in')}}"></a></h3>
    @endif
</div>