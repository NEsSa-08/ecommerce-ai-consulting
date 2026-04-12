<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    // Listar productos
    public function index()
    {
        $productos = Producto::with(['usuario', 'categorias'])->get();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $this->authorize('crear', Producto::class);
        return view('productos.create');
    }

    // Guardar producto nuevo
    public function store(Request $request)
    {
        $this->authorize('crear', Producto::class);

        $producto = Producto::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'existencia'  => $request->existencia,
            'usuario_id'  => auth()->id(),
        ]);

        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario_id'  => auth()->id(),
        ]);

        return redirect('/productos')->with('success', 'Producto creado.');
    }

    // Mostrar formulario de edición
    public function edit(Producto $producto)
    {
        $this->authorize('editar', $producto);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $this->authorize('editar', $producto);

        $producto->update($request->only(['nombre', 'descripcion', 'precio', 'existencia']));

        Log::channel('productos')->info('Producto editado', [
            'producto_id' => $producto->id,
            'usuario_id'  => auth()->id(),
        ]);

        return redirect('/productos')->with('success', 'Producto actualizado.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $this->authorize('eliminar', $producto);

        Log::channel('productos')->warning('Producto eliminado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario_id'  => auth()->id(),
        ]);

        $producto->delete();
        return redirect('/productos')->with('success', 'Producto eliminado.');
    }
}