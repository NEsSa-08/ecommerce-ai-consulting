@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Nuevo usuario</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/users">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos"
                           class="form-control @error('apellidos') is-invalid @enderror"
                           value="{{ old('apellidos') }}">
                    @error('apellidos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo"
                           class="form-control @error('correo') is-invalid @enderror"
                           value="{{ old('correo') }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="clave"
                           class="form-control @error('clave') is-invalid @enderror">
                    @error('clave')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" name="clave_confirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-control @error('rol') is-invalid @enderror">
                        <option value="">-- Selecciona un rol --</option>
                        <option value="administrador" {{ old('rol') === 'administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="gerente" {{ old('rol') === 'gerente' ? 'selected' : '' }}>Gerente</option>
                        <option value="cliente" {{ old('rol') === 'cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                    @error('rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                <a href="/users" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection