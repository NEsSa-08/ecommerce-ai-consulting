<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('verDashboard', Usuario::class);

        // Total de usuarios
        $totalUsuarios = Usuario::count();

        // Total de vendedores (gerentes)
        $totalVendedores = Usuario::where('rol', 'gerente')->count();

        // Total de compradores (clientes)
        $totalCompradores = Usuario::where('rol', 'cliente')->count();

        // Productos por categoría
        $productosPorCategoria = Categoria::withCount('productos')->get();

        // Producto más vendido
        $productoMasVendido = Producto::withCount('ventas')
            ->orderBy('ventas_count', 'desc')
            ->first();

        // Comprador más frecuente por categoría
        $compradorFrecuente = Usuario::where('rol', 'cliente')
            ->withCount('ventasComoCliente')
            ->orderBy('ventas_como_cliente_count', 'desc')
            ->first();

        // Ventas recientes
        $ventasRecientes = Venta::with(['producto', 'cliente', 'vendedor'])
            ->latest()
            ->take(5)
            ->get();

        // Total de ventas
        $totalVentas = Venta::count();

        // Total ingresos
        $totalIngresos = Venta::where('validada', true)->sum('total');

        return view('admin', compact(
            'totalUsuarios',
            'totalVendedores',
            'totalCompradores',
            'productosPorCategoria',
            'productoMasVendido',
            'compradorFrecuente',
            'ventasRecientes',
            'totalVentas',
            'totalIngresos'
        ));
    }
}