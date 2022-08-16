@if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@elseif (session()->has('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@elseif (session()->has('primary'))
    <div class="alert alert-primary">{{ session('primary') }}</div>
@elseif (session()->has('danger'))
    <div class="alert alert-danger">{{ session('danger') }}</div>
@endif