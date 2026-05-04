<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreVentaRequest;
use Illuminate\Support\Facades\Storage;
use App\Mail\VentaValidadaCompradorMail;
use App\Mail\VentaValidadaVendedorMail;
use Illuminate\Support\Facades\Mail;



class VentaController extends Controller
{
    // Listar ventas
    public function index()
{
    $usuario = auth()->user();

    // Cliente solo ve sus propias compras
    if ($usuario->rol === 'cliente') {
        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])
            ->where('cliente_id', $usuario->id)
            ->get();
    } else {
        // Gerente y admin ven todas
        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])->get();
    }

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

    // Guardar ticket en disco privado
    $ticketPath = null;
    if ($request->hasFile('ticket')) {
        $ticketPath = $request->file('ticket')->store('tickets', 'privado');
    }

    $venta = Venta::create([
        'producto_id' => $request->producto_id,
        'vendedor_id' => auth()->id(),
        'cliente_id'  => $request->cliente_id,
        'fecha'       => $request->fecha,
        'total'       => $producto->precio,
        'ticket'      => $ticketPath,
        'validada'    => false,
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

// Método para servir el ticket de forma privada
public function verTicket(Venta $venta)
{
    $this->authorize('verTicket', $venta);

    if (!$venta->ticket || !Storage::disk('privado')->exists($venta->ticket)) {
        abort(404, 'Ticket no encontrado.');
    }

    return response()->file(
        storage_path('app/privado/' . $venta->ticket)
    );
}

    // Eliminar venta
    public function destroy(Venta $venta)
    {
        $this->authorize('eliminar', $venta);
        $venta->delete();
        return redirect('/ventas')->with('success', 'Venta eliminada.');
    }

    // Mostrar formulario de compra para cliente
public function comprarForm(Producto $producto)
{
    if ($producto->existencia <= 0) {
        return redirect('/catalogo')->withErrors(['error' => 'Este producto no tiene stock disponible.']);
    }
    return view('ventas.comprar', compact('producto'));
}

// Procesar compra del cliente
public function comprar(Request $request, Producto $producto)
{
    $request->validate([
        'ticket' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $ticketPath = null;
    if ($request->hasFile('ticket')) {
        $ticketPath = $request->file('ticket')->store('tickets', 'privado');
    }

    $venta = Venta::create([
        'producto_id' => $producto->id,
        'vendedor_id' => $producto->usuario_id,
        'cliente_id'  => auth()->id(),
        'fecha'       => now()->toDateString(),
        'total'       => $producto->precio,
        'ticket'      => $ticketPath,
        'validada'    => false,
    ]);

    Log::channel('ventas')->info('Compra realizada por cliente', [
        'venta_id'    => $venta->id,
        'producto_id' => $producto->id,
        'cliente_id'  => auth()->id(),
        'total'       => $venta->total,
        'ip'          => request()->ip(),
    ]);

    return redirect('/ventas')->with('success', '¡Compra realizada exitosamente!');
}

public function validar(Venta $venta)
{
    $this->authorize('validar', $venta);

    $venta->update(['validada' => true]);

    // Enviar ambos correos en un solo envío
    Mail::to($venta->vendedor->correo)
        ->cc($venta->cliente->correo)
        ->send(new VentaValidadaVendedorMail($venta));

    Log::channel('ventas')->info('Venta validada', [
        'venta_id'     => $venta->id,
        'validada_por' => auth()->id(),
    ]);

    return redirect('/ventas')->with('success', 'Venta validada y notificaciones enviadas.');
}

}