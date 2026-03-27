<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
<div class="col-md-4">

<h2 class="text-center">Registro</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/register">
    @csrf

    <input class="form-control mb-2 @error('name') is-invalid @enderror" name="name" placeholder="Nombre" value="{{ old('name') }}">
    <input class="form-control mb-2 @error('email') is-invalid @enderror" name="email" placeholder="Correo" value="{{ old('email') }}">
    <input class="form-control mb-2 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Contraseña">
    <input class="form-control mb-2" type="password" name="password_confirmation" placeholder="Confirmar contraseña">
   
    <select class="form-control mb-2" name="rol">
        <option value="cliente">Cliente</option>
        <option value="empleado">Empleado</option>
        <option value="gerente">Gerente</option>
    </select>

    <button class="btn btn-success w-100">Registrarse</button>
</form>

</div>
</div>

@endsection