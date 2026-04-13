@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Usuarios</h2>
        @if(auth()->user()->rol === 'administrador')
            <a href="/users/create" class="btn btn-primary">+ Nuevo usuario</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->apellidos }}</td>
                <td>{{ $user->correo }}</td>
                <td>
                    <span class="badge 
                        {{ $user->rol === 'administrador' ? 'bg-danger' : '' }}
                        {{ $user->rol === 'gerente' ? 'bg-warning text-dark' : '' }}
                        {{ $user->rol === 'cliente' ? 'bg-success' : '' }}">
                        {{ ucfirst($user->rol) }}
                    </span>
                </td>
                <td>
                    @can('editar', $user)
                        <a href="/users/edit/{{ $user->id }}" class="btn btn-sm btn-warning">Editar</a>
                    @endcan
                    @can('eliminar', $user)
                        <a href="/users/delete/{{ $user->id }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay usuarios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection