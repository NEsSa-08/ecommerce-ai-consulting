@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')
@use('Illuminate\Support\Str')

@section('content')
<div class="container mt-4">
    <div class="page-header">
        <h2>Catálogo de productos</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($productos as $producto)
        <div class="col-md-4">
            <div class="card h-100">
                {{-- Foto --}}
                @if($producto->fotos && count($producto->fotos) > 0)
                    <img src="{{ Storage::disk('public')->url($producto->fotos[0]) }}"
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                @else
                    <div style="background: linear-gradient(135deg, #f1f5f9, #e2e8f0); height: 200px; display: flex; align-items: center; justify-content: center; font-size: 56px; border-radius: 12px 12px 0 0;">
                        🤖
                    </div>
                @endif

                <div style="padding: 20px;">
                    {{-- Categorías --}}
                    <div style="margin-bottom: 8px;">
                        @foreach($producto->categorias->take(2) as $cat)
                            <span class="badge bg-primary" style="font-size: 0.7rem;">{{ $cat->nombre }}</span>
                        @endforeach
                    </div>

                    <h5 style="font-weight: 700; color: #0f172a; margin-bottom: 8px;">
                        {{ $producto->nombre }}
                    </h5>
                    <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 16px; line-height: 1.5;">
                        {{ Str::limit($producto->descripcion, 100) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="font-size: 1.3rem; font-weight: 800; color: #0f172a;">
                            ${{ number_format($producto->precio, 2) }}
                        </span>
                        <span style="font-size: 0.75rem; color: {{ $producto->existencia > 0 ? '#16a34a' : '#dc2626' }}; font-weight: 600;">
                            {{ $producto->existencia > 0 ? $producto->existencia.' disponibles' : 'Sin stock' }}
                        </span>
                    </div>

                    @if($producto->existencia > 0)
                        <a href="/comprar/{{ $producto->id }}" class="btn btn-primary w-100">
                            🛒 Comprar ahora
                        </a>
                    @else
                        <button class="btn btn-secondary w-100" disabled>Sin stock</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted mt-4">
            No hay productos disponibles.
        </div>
        @endforelse
    </div>
</div>
@endsection