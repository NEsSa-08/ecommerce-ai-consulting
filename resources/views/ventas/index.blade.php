@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ventas</h2>
        @if(auth()->user()->rol !== 'cliente')
            <a href="/ventas/create" class="btn btn-primary">+ Nueva venta</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total</th>
                @if(auth()->user()->rol === 'administrador')
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->producto->nombre }}</td>
                <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</td>
                <td>{{ $venta->vendedor->nombre }} {{ $venta->vendedor->apellidos }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                @if(auth()->user()->rol === 'administrador')
                    <td>
                        <a href="/ventas/delete/{{ $venta->id }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar esta venta?')">Eliminar</a>
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay ventas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection