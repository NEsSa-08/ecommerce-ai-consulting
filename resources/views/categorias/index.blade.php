@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorías</h2>
        @if(auth()->user()->rol === 'administrador' || auth()->user()->rol === 'gerente')
            <a href="/categorias/create" class="btn btn-primary">+ Nueva categoría</a>
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
                <th>Descripción</th>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>
                    @foreach($categoria->productos as $producto)
                        <span class="badge bg-secondary">{{ $producto->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    @if(auth()->user()->rol === 'administrador' || auth()->user()->rol === 'gerente')
                        <a href="/categorias/edit/{{ $categoria->id }}" class="btn btn-sm btn-warning">Editar</a>
                    @endif
                    @if(auth()->user()->rol === 'administrador')
                        <a href="/categorias/delete/{{ $categoria->id }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay categorías registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection