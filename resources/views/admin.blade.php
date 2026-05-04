@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div style="background: linear-gradient(135deg, #0f172a, #1e293b); border-radius: 16px; padding: 40px; margin-bottom: 32px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 style="color: #fff; font-weight: 800; margin-bottom: 8px;">
                    Dashboard Administrador
                </h2>
                <p style="color: #94a3b8; margin: 0;">
                    Bienvenido, {{ auth()->user()->nombre }} — Vista general del sistema
                </p>
            </div>
            <div style="font-size: 64px; opacity: 0.15;">📊</div>
        </div>
    </div>

    {{-- Métricas principales --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <div style="font-size: 36px; margin-bottom: 8px;">👥</div>
                <div style="font-size: 2rem; font-weight: 800; color: #4f46e5;">{{ $totalUsuarios }}</div>
                <div style="color: #64748b; font-size: 0.85rem;">Total usuarios</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <div style="font-size: 36px; margin-bottom: 8px;">🤝</div>
                <div style="font-size: 2rem; font-weight: 800; color: #0891b2;">{{ $totalVendedores }}</div>
                <div style="color: #64748b; font-size: 0.85rem;">Vendedores</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <div style="font-size: 36px; margin-bottom: 8px;">🛒</div>
                <div style="font-size: 2rem; font-weight: 800; color: #16a34a;">{{ $totalCompradores }}</div>
                <div style="color: #64748b; font-size: 0.85rem;">Compradores</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <div style="font-size: 36px; margin-bottom: 8px;">💰</div>
                <div style="font-size: 2rem; font-weight: 800; color: #d97706;">${{ number_format($totalIngresos, 0) }}</div>
                <div style="color: #64748b; font-size: 0.85rem;">Ingresos validados</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        {{-- Productos por categoría --}}
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h6 style="font-weight: 700; margin-bottom: 16px;">📦 Productos por categoría</h6>
                @forelse($productosPorCategoria as $cat)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                    <span style="font-size: 0.9rem; color: #1e293b;">{{ $cat->nombre }}</span>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="background: #e0e7ff; border-radius: 20px; height: 8px; width: 80px; overflow: hidden;">
                            <div style="background: #6366f1; height: 100%; width: {{ $productosPorCategoria->max('productos_count') > 0 ? ($cat->productos_count / $productosPorCategoria->max('productos_count')) * 100 : 0 }}%;"></div>
                        </div>
                        <span class="badge bg-primary">{{ $cat->productos_count }}</span>
                    </div>
                </div>
                @empty
                <p class="text-muted">No hay categorías.</p>
                @endforelse
            </div>
        </div>

        {{-- Stats de ventas --}}
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h6 style="font-weight: 700; margin-bottom: 16px;">🏆 Estadísticas destacadas</h6>

                {{-- Producto más vendido --}}
                <div style="background: #f0fdf4; border-radius: 10px; padding: 16px; margin-bottom: 12px;">
                    <div style="font-size: 0.75rem; color: #16a34a; font-weight: 600; margin-bottom: 4px;">PRODUCTO MÁS VENDIDO</div>
                    @if($productoMasVendido)
                        <div style="font-weight: 700; color: #0f172a;">{{ $productoMasVendido->nombre }}</div>
                        <div style="font-size: 0.85rem; color: #64748b;">{{ $productoMasVendido->ventas_count }} ventas registradas</div>
                    @else
                        <div style="color: #64748b; font-size: 0.85rem;">Sin ventas aún</div>
                    @endif
                </div>

                {{-- Comprador más frecuente --}}
                <div style="background: #eff6ff; border-radius: 10px; padding: 16px; margin-bottom: 12px;">
                    <div style="font-size: 0.75rem; color: #1d4ed8; font-weight: 600; margin-bottom: 4px;">COMPRADOR MÁS FRECUENTE</div>
                    @if($compradorFrecuente)
                        <div style="font-weight: 700; color: #0f172a;">{{ $compradorFrecuente->nombre }} {{ $compradorFrecuente->apellidos }}</div>
                        <div style="font-size: 0.85rem; color: #64748b;">{{ $compradorFrecuente->ventas_como_cliente_count }} compras realizadas</div>
                    @else
                        <div style="color: #64748b; font-size: 0.85rem;">Sin compradores aún</div>
                    @endif
                </div>

                {{-- Total ventas --}}
                <div style="background: #fdf4ff; border-radius: 10px; padding: 16px;">
                    <div style="font-size: 0.75rem; color: #7c3aed; font-weight: 600; margin-bottom: 4px;">TOTAL VENTAS</div>
                    <div style="font-weight: 700; font-size: 1.5rem; color: #0f172a;">{{ $totalVentas }}</div>
                    <div style="font-size: 0.85rem; color: #64748b;">transacciones registradas</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ventas recientes --}}
    <div class="card p-4 mb-4">
        <h6 style="font-weight: 700; margin-bottom: 16px;">🕐 Ventas recientes</h6>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventasRecientes as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</td>
                    <td>{{ $venta->vendedor->nombre }} {{ $venta->vendedor->apellidos }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>
                        @if($venta->validada)
                            <span class="badge bg-success">Validada</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay ventas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Accesos rápidos --}}
    <div class="row g-3">
        <div class="col-md-3">
            <a href="/users" class="card p-3 text-center text-decoration-none">
                <div style="font-size: 28px;">👤</div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b;">Usuarios</div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/productos" class="card p-3 text-center text-decoration-none">
                <div style="font-size: 28px;">🤖</div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b;">Productos</div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/categorias" class="card p-3 text-center text-decoration-none">
                <div style="font-size: 28px;">🏷️</div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b;">Categorías</div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/ventas" class="card p-3 text-center text-decoration-none">
                <div style="font-size: 28px;">💼</div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b;">Ventas</div>
            </a>
        </div>
    </div>

</div>
@endsection