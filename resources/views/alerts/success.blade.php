@if (session($key ?? 'success'))
    <div class="alert alert-success" role="alert">
        {{ session($key ?? 'success') }}
    </div>
@endif
@if (session($key ?? 'error'))
    <div class="alert alert-danger" role="alert">
        {{ session($key ?? 'error') }}
    </div>
@endif
