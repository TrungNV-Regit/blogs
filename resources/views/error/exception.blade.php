@if (session('error'))
<div>
    <h3> {{ session('error') }}</h3>
</div>
@endif

@if(isset($error))
<div>
    <h3>{{ $error }}</h3>
</div>
@endif
