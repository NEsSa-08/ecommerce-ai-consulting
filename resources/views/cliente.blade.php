@extends('layouts.app')

@use('Illuminate\Support\Facades\Storage')
@use('Illuminate\Support\Str')

@section('content')
<div class="container mt-4">

    {{-- Saludo --}}
    <div style="background: linear-gradient(135deg, #0f172a, #1e293b); border-radius: 16px; padding: 40px; margin-bottom: 32px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 style="color: #fff; font-weight: 800; margin-bottom: 8px;">
                    Hola, {{ auth()->user()->nombre }} 👋
                </h2>
                <p style="color: #94a3b8; margin: 0;">Bienvenido a AI Consulting Store</p>
            </div>
            <div style="font-size: 64px; opacity: 0.2;">🛍️</div>
        </div>
    </div>

    {{-- Accesos rápidos --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 40px;">🤖</div>
                    <div>
                        <h5 style="font-weight: 700; margin-bottom: 4px;">Explorar productos</h5>
                        <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 12px;">
                            Descubre nuestras soluciones de IA disponibles
                        </p>
                        <a href="/catalogo" class="btn btn-primary btn-sm">Ver catálogo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 40px;">📦</div>
                    <div>
                        <h5 style="font-weight: 700; margin-bottom: 4px;">Mis compras</h5>
                        <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 12px;">
                            Consulta el historial de tus compras
                        </p>
                        <a href="/ventas" class="btn btn-success btn-sm">Ver compras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Productos destacados --}}
    <h5 style="font-weight: 700; margin-bottom: 16px;">Productos disponibles</h5>
    <div class="row g-3">
        @foreach(\App\Models\Producto::with(['categorias','usuario'])->take(6)->get() as $producto)
        <div class="col-md-4">
            <div class="card h-100">
                {{-- Foto del producto --}}
                @if($producto->fotos && count($producto->fotos) > 0)
                    <img src="{{ Storage::disk('public')->url($producto->fotos[0]) }}"
                         style="width: 100%; height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                @else
                    <div style="background: linear-gradient(135deg, #f1f5f9, #e2e8f0); height: 180px; display: flex; align-items: center; justify-content: center; font-size: 48px; border-radius: 12px 12px 0 0;">
                        🤖
                    </div>
                @endif

                <div style="padding: 16px;">
                    {{-- Categorías --}}
                    <div style="margin-bottom: 8px;">
                        @foreach($producto->categorias->take(2) as $cat)
                            <span class="badge bg-primary" style="font-size: 0.7rem;">{{ $cat->nombre }}</span>
                        @endforeach
                    </div>

                    <h6 style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                        {{ $producto->nombre }}
                    </h6>
                    <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 12px; line-height: 1.4;">
                        {{ Str::limit($producto->descripcion, 80) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size: 1.2rem; font-weight: 800; color: #0f172a;">
                            ${{ number_format($producto->precio, 2) }}
                        </span>
                        <span style="font-size: 0.75rem; color: #64748b;">
                            {{ $producto->existencia }} disponibles
                        </span>
                    </div>

                    {{-- Botón de contacto en lugar de comprar --}}
                    <a href="/contacto" class="btn btn-primary w-100 mt-3" style="font-size: 0.85rem;">
                        Solicitar información
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection