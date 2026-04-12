<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Listar categorías
    public function index()
    {
        $categorias = Categoria::with('productos')->get();
        return view('categorias.index', compact('categorias'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $this->authorize('create', Categoria::class);
        return view('categorias.create');
    }

    // Guardar categoría nueva
    public function store(Request $request)
    {
        $this->authorize('create', Categoria::class);

        Categoria::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/categorias')->with('success', 'Categoría creada.');
    }

    // Mostrar formulario de edición
    public function edit(Categoria $categoria)
    {
        $this->authorize('update', $categoria);
        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar categoría
    public function update(Request $request, Categoria $categoria)
    {
        $this->authorize('update', $categoria);

        $categoria->update($request->only(['nombre', 'descripcion']));

        return redirect('/categorias')->with('success', 'Categoría actualizada.');
    }

    // Eliminar categoría
    public function destroy(Categoria $categoria)
    {
        $this->authorize('delete', $categoria);
        $categoria->delete();
        return redirect('/categorias')->with('success', 'Categoría eliminada.');
    }
}