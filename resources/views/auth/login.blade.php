<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
<div class="col-md-4">

<h2 class="text-center">Iniciar sesión</h2>

@if ($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="/login">
    @csrf

    <input class="form-control mb-2 @error('email') is-invalid @enderror" name="email" placeholder="Correo" value="{{ old('email') }}">
    <input class="form-control mb-2 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Contraseña">  
    
    <button class="btn btn-primary w-100">Entrar</button>
</form>

</div>
</div>

@endsection