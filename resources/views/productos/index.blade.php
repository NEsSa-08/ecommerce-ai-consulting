@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
        @if(auth()->user()->rol === 'administrador' || auth()->user()->rol === 'gerente')
            <a href="/productos/create" class="btn btn-primary">+ Nuevo producto</a>
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
                <th>Precio</th>
                <th>Existencia</th>
                <th>Vendedor</th>
                <th>Categorías</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->existencia }}</td>
                <td>{{ $producto->usuario->nombre }} {{ $producto->usuario->apellidos }}</td>
                <td>
                    @foreach($producto->categorias as $categoria)
                        <span class="badge bg-secondary">{{ $categoria->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    @if(auth()->user()->rol === 'administrador' || auth()->user()->rol === 'gerente')
                        <a href="/productos/edit/{{ $producto->id }}" class="btn btn-sm btn-warning">Editar</a>
                    @endif
                    @if(auth()->user()->rol === 'administrador')
                        <a href="/productos/delete/{{ $producto->id }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                    @endif
                </td>
                <td>
    @if($producto->fotos && count($producto->fotos) > 0)
        @foreach($producto->fotos as $foto)
            <img src="{{ Storage::disk('public')->url($foto) }}"
                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; margin: 2px;">
        @endforeach
    @else
        <span class="text-muted" style="font-size: 0.8rem;">Sin fotos</span>
    @endif
</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay productos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection