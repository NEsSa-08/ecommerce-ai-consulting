<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // LISTAR
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // FORM CREAR
    public function create()
    {
        return view('users.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol
        ]);

        return redirect('/users');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol
        ]);

        return redirect('/users');
    }

    // ELIMINAR
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/users');
    }
}