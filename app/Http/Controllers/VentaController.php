<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreVentaRequest;

class VentaController extends Controller
{
    // Listar ventas
    public function index()
    {
        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])->get();
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $this->authorize('crear', Venta::class);

        $productos = Producto::all();
        $clientes  = Usuario::where('rol', 'cliente')->get();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    // Guardar venta nueva
 public function store(StoreVentaRequest $request)
{
    $this->authorize('crear', Venta::class);

    $producto = Producto::findOrFail($request->producto_id);

    $venta = Venta::create([
        'producto_id' => $request->producto_id,
        'vendedor_id' => auth()->id(),
        'cliente_id'  => $request->cliente_id,
        'fecha'       => $request->fecha,
        'total'       => $producto->precio,
    ]);

    Log::channel('ventas')->info('Venta creada', [
        'venta_id'    => $venta->id,
        'producto_id' => $venta->producto_id,
        'cliente_id'  => $venta->cliente_id,
        'vendedor_id' => $venta->vendedor_id,
        'total'       => $venta->total,
        'ip'          => request()->ip(),
    ]);

    return redirect('/ventas')->with('success', 'Venta registrada.');
}

    // Eliminar venta
    public function destroy(Venta $venta)
    {
        $this->authorize('eliminar', $venta);
        $venta->delete();
        return redirect('/ventas')->with('success', 'Venta eliminada.');
    }
}