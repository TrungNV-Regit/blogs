<form action="{{ route('auth.logout') }}" method="POST">
    @csrf
    @method('POST')
    <button type="submit">Logout</button>
</form>