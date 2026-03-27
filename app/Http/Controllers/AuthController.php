<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'El correo es obligatorio',
        'email.email' => 'Formato de correo inválido',
        'password.required' => 'La contraseña es obligatoria'
    ]);

    if (Auth::attempt($request->only('email','password'))) {

        $user = Auth::user();

        if ($user->rol == 'cliente') return redirect('/cliente');
        if ($user->rol == 'empleado') return redirect('/empleado');
        return redirect('/gerente');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas'
    ])->withInput();
}
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'rol' => 'required'
    ], [
        'name.required' => 'El nombre es obligatorio',
        'email.required' => 'El correo es obligatorio',
        'email.email' => 'El correo no es válido',
        'email.unique' => 'Este correo ya está registrado',
        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'rol.required' => 'Debes seleccionar un rol'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'rol' => $request->rol
    ]);

    return redirect('/login')->with('success', 'Registro exitoso');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}