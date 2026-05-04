@extends('layouts.app')

@section('content')

{{-- Hero Banner --}}
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 16px; padding: 60px 40px; margin-bottom: 40px; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -40px; right: -40px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
    <div class="row align-items-center">
        <div class="col-md-7">
            <span style="background: rgba(99,102,241,0.2); color: #818cf8; font-size: 12px; font-weight: 600; padding: 4px 14px; border-radius: 20px; letter-spacing: 1px;">AI CONSULTING STORE</span>
            <h1 style="color: #fff; font-size: 2.8rem; font-weight: 800; margin-top: 16px; line-height: 1.2;">
                Tecnología inteligente<br>
                <span style="color: #6366f1;">para tu negocio</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1.05rem; margin-top: 16px; max-width: 480px;">
                Descubre nuestros productos y servicios de inteligencia artificial. Soluciones diseñadas para transformar tu empresa.
            </p>
            <div class="mt-4 d-flex gap-3">
                @guest
                    <a href="/register" class="btn btn-primary px-4 py-2">Comenzar ahora</a>
                    <a href="/login" class="btn btn-outline-light px-4 py-2">Iniciar sesión</a>
                @endguest
                @auth
                    <a href="/catalogo" class="btn btn-primary px-4 py-2">Ver productos</a>
                    <a href="/ventas" class="btn btn-outline-light px-4 py-2">Mis compras</a>
                @endauth
            </div>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
            <div style="font-size: 120px; opacity: 0.15;">🤖</div>
        </div>
    </div>
</div>

{{-- Barra de búsqueda estilo Amazon --}}
<div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px 24px; margin-bottom: 40px;">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar productos, servicios, soluciones IA..."
                       style="border-right: none; font-size: 0.95rem;">
                <button class="btn btn-primary px-4">
                    🔍 Buscar
                </button>
            </div>
        </div>
        <div class="col-md-4 mt-3 mt-md-0 d-flex gap-2 justify-content-md-end">
            <a href="/quienes-somos" class="btn btn-outline-secondary btn-sm">Quiénes somos</a>
            <a href="/contacto" class="btn btn-outline-secondary btn-sm">Contacto</a>
        </div>
    </div>
</div>

{{-- Categorías destacadas --}}
<div class="mb-4">
    <h5 style="font-weight: 700; color: #0f172a; margin-bottom: 16px;">Explora por categoría</h5>
    <div class="row g-3">
        @php
    $cats = [
        ['icon' => '🤝', 'nombre' => 'Consultoría', 'color' => '#6366f1'],
        ['icon' => '🤖', 'nombre' => 'Automatización', 'color' => '#06b6d4'],
        ['icon' => '🧠', 'nombre' => 'Machine Learning', 'color' => '#8b5cf6'],
        ['icon' => '💬', 'nombre' => 'Chatbots', 'color' => '#f59e0b'],
        ['icon' => '📊', 'nombre' => 'Business Intelligence', 'color' => '#10b981'],
        ['icon' => '👁️', 'nombre' => 'Visión Artificial', 'color' => '#0ea5e9'],
    ];
@endphp
        @foreach($cats as $cat)
        <div class="col-6 col-md-2">
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px 10px; text-align: center; cursor: pointer; transition: all 0.2s;"
                 onmouseover="this.style.borderColor='{{ $cat['color'] }}'; this.style.transform='translateY(-2px)'"
                 onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'">
                <div style="font-size: 32px; margin-bottom: 8px;">{{ $cat['icon'] }}</div>
                <div style="font-size: 0.78rem; font-weight: 600; color: #1e293b;">{{ $cat['nombre'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Productos destacados --}}
@auth
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 style="font-weight: 700; color: #0f172a; margin: 0;">Productos disponibles</h5>
        <a href="/catalogo" style="font-size: 0.85rem; color: #6366f1; text-decoration: none; font-weight: 600;">Ver todos →</a>
    </div>
    <div class="row g-3">
        @foreach(\App\Models\Producto::with(['categorias','usuario'])->take(4)->get() as $producto)
        <div class="col-md-3">
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; height: 100%; transition: all 0.2s;"
                 onmouseover="this.style.boxShadow='0 8px 24px rgba(99,102,241,0.12)'; this.style.transform='translateY(-2px)'"
                 onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                <div style="background: linear-gradient(135deg, #f1f5f9, #e2e8f0); height: 140px; display: flex; align-items: center; justify-content: center; font-size: 48px;">
                    🛍️
                </div>
                <div style="padding: 16px;">
                    <div style="font-size: 0.7rem; color: #6366f1; font-weight: 600; margin-bottom: 4px;">
                        @foreach($producto->categorias->take(1) as $cat)
                            {{ $cat->nombre }}
                        @endforeach
                    </div>
                    <h6 style="font-weight: 700; font-size: 0.9rem; color: #0f172a; margin-bottom: 6px;">{{ $producto->nombre }}</h6>
                    <p style="font-size: 0.78rem; color: #64748b; margin-bottom: 12px; line-height: 1.4;">
                        {{ Str::limit($producto->descripcion, 60) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">${{ number_format($producto->precio, 2) }}</span>
                        <span style="font-size: 0.75rem; color: #64748b;">{{ $producto->existencia }} disponibles</span>
                    </div>
                    <a href="/ventas/create" class="btn btn-primary w-100 mt-3" style="font-size: 0.85rem;">
                        Comprar ahora
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endauth

{{-- Servicios / Features estilo tienda --}}
<div class="row g-3 mb-5">
    @php
        $features = [
            ['icon' => '🚚', 'titulo' => 'Entrega inmediata', 'desc' => 'Acceso instantáneo a todos nuestros servicios digitales.'],
            ['icon' => '🔐', 'titulo' => 'Seguridad garantizada', 'desc' => 'Tus datos y transacciones protegidos en todo momento.'],
            ['icon' => '🎯', 'titulo' => 'Soporte especializado', 'desc' => 'Equipo de expertos disponible para ayudarte.'],
            ['icon' => '💡', 'titulo' => 'Soluciones a medida', 'desc' => 'Productos adaptados a las necesidades de tu empresa.'],
        ];
    @endphp
    @foreach($features as $f)
    <div class="col-md-3">
        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; text-align: center;">
            <div style="font-size: 36px; margin-bottom: 12px;">{{ $f['icon'] }}</div>
            <h6 style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">{{ $f['titulo'] }}</h6>
            <p style="font-size: 0.82rem; color: #64748b; margin: 0;">{{ $f['desc'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- CTA final --}}
@guest
<div style="background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 16px; padding: 48px; text-align: center; margin-bottom: 20px;">
    <h3 style="color: #fff; font-weight: 800; margin-bottom: 12px;">¿Listo para transformar tu negocio?</h3>
    <p style="color: rgba(255,255,255,0.8); margin-bottom: 24px;">Regístrate gratis y accede a todos nuestros productos y servicios.</p>
    <a href="/register" class="btn btn-light px-5 py-2" style="font-weight: 600; border-radius: 8px;">
        Crear cuenta gratis
    </a>
</div>
@endguest

@endsection