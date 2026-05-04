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
                <th>Estado</th>
                <th>Ticket</th>
                @if(auth()->user()->rol !== 'cliente')
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
                <td>
                    @if($venta->validada)
                        <span class="badge bg-success">Validada</span>
                    @else
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @endif
                </td>
                <td>
                    @if($venta->ticket)
                        <a href="/ventas/ticket/{{ $venta->id }}" class="btn btn-sm btn-info" target="_blank">Ver ticket</a>
                    @else
                        <span class="text-muted" style="font-size: 0.8rem;">Sin ticket</span>
                    @endif
                </td>
                @if(auth()->user()->rol !== 'cliente')
                    <td>
                        @if(!$venta->validada && (auth()->user()->rol === 'gerente' || auth()->user()->rol === 'administrador'))
                            <form method="POST" action="/ventas/validar/{{ $venta->id }}" style="display:inline">
                                @csrf
                                <button class="btn btn-sm btn-success"
                                        onclick="return confirm('¿Validar esta venta?')">
                                    Validar
                                </button>
                            </form>
                        @endif
                        @if(auth()->user()->rol === 'administrador')
                            <a href="/ventas/delete/{{ $venta->id }}" class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar esta venta?')">Eliminar</a>
                        @endif
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No hay ventas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection