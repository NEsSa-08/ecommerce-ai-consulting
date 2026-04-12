<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('productos')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $this->authorize('create', Categoria::class);
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Categoria::class);

        $request->validate([
            'nombre'      => 'required|string|min:2|max:100|unique:categorias,nombre',
            'descripcion' => 'required|string|max:500',
        ]);

        Categoria::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/categorias')->with('success', 'Categoría creada.');
    }

    public function edit(Categoria $categoria)
    {
        $this->authorize('update', $categoria);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $this->authorize('update', $categoria);

        $request->validate([
            'nombre'      => "required|string|min:2|max:100|unique:categorias,nombre,{$categoria->id}",
            'descripcion' => 'required|string|max:500',
        ]);

        $categoria->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/categorias')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        $this->authorize('delete', $categoria);
        $categoria->delete();
        return redirect('/categorias')->with('success', 'Categoría eliminada.');
    }
}