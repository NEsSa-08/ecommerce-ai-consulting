@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Nueva venta</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/ventas" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <select name="producto_id" class="form-control @error('producto_id') is-invalid @enderror">
                        <option value="">-- Selecciona un producto --</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                        <option value="">-- Selecciona un cliente --</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellidos }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha"
                           class="form-control @error('fecha') is-invalid @enderror"
                           value="{{ old('fecha', date('Y-m-d')) }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
    <label class="form-label">Ticket de pago <span class="text-muted">(opcional)</span></label>
    <input type="file" name="ticket" class="form-control @error('ticket') is-invalid @enderror"
           accept="image/*">
    @error('ticket')

    //ticket
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Imagen del comprobante de pago (jpg, png).</small>
</div>
                <button type="submit" class="btn btn-primary w-100">Registrar venta</button>
                <a href="/ventas" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection