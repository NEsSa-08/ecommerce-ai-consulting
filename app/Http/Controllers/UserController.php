<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = Usuario::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('crear', Usuario::class);
        return view('users.create');
    }

    public function store(StoreUsuarioRequest $request)
    {
        $this->authorize('crear', Usuario::class);

        Usuario::create([
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo'    => $request->correo,
            'clave'     => Hash::make($request->clave),
            'rol'       => $request->rol,
        ]);

        return redirect('/users')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $user = Usuario::findOrFail($id);
        $this->authorize('editar', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUsuarioRequest $request, $id)
    {
        $user = Usuario::findOrFail($id);
        $this->authorize('editar', $user);

        $user->update([
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo'    => $request->correo,
            'rol'       => $request->rol,
        ]);

        return redirect('/users')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = Usuario::findOrFail($id);
        $this->authorize('eliminar', $user);
        $user->delete();
        return redirect('/users')->with('success', 'Usuario eliminado correctamente.');
    }
}