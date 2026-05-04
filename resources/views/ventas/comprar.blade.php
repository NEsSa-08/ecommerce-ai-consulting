@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 24px;">Confirmar compra</h4>

                {{-- Resumen del producto --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                    <div class="d-flex gap-3 align-items-center">
                        @if($producto->fotos && count($producto->fotos) > 0)
                            <img src="{{ Storage::disk('public')->url($producto->fotos[0]) }}"
                                 style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                        @else
                            <div style="width: 70px; height: 70px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 32px;">🤖</div>
                        @endif
                        <div>
                            <h6 style="font-weight: 700; margin-bottom: 4px;">{{ $producto->nombre }}</h6>
                            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 4px;">{{ Str::limit($producto->descripcion, 80) }}</p>
                            <span style="font-size: 1.2rem; font-weight: 800; color: #4f46e5;">${{ number_format($producto->precio, 2) }}</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="/comprar/{{ $producto->id }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Comprobante de pago <span class="text-muted">(opcional)</span></label>
                        <input type="file" name="ticket" class="form-control @error('ticket') is-invalid @enderror" accept="image/*">
                        @error('ticket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Sube tu comprobante de pago (jpg, png).</small>
                    </div>

                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px; margin-bottom: 20px;">
                        <div class="d-flex justify-content-between">
                            <span style="font-weight: 600;">Total a pagar:</span>
                            <span style="font-size: 1.2rem; font-weight: 800; color: #16a34a;">${{ number_format($producto->precio, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">✅ Confirmar compra</button>
                    <a href="/catalogo" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection