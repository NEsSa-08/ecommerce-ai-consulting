<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave'  => 'required',
        ]);

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->clave, // Auth internamente usa 'password'
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            $usuario = Auth::user();

            Log::channel('autenticacion')->info('Login exitoso', [
                'usuario_id' => $usuario->id,
                'correo'     => $usuario->correo,
                'ip'         => $request->ip(),
            ]);

            return match($usuario->rol) {
                'administrador' => redirect('/admin/dashboard'),
                'gerente'       => redirect('/gerente'),
                default         => redirect('/cliente'),
            };
        }

        Log::channel('autenticacion')->warning('Login fallido', [
            'correo' => $request->correo,
            'ip'     => $request->ip(),
        ]);

        return back()->withErrors(['correo' => 'Credenciales incorrectas.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo'    => 'required|email|unique:usuarios,correo',
            'clave'     => 'required|min:6|confirmed',
        ]);

        Usuario::create([
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo'    => $request->correo,
            'clave'     => Hash::make($request->clave),
            'rol'       => 'cliente',
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente.');
    }

    public function logout(Request $request)
    {
        $usuario = Auth::user();

        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => $usuario->id,
            'correo'     => $usuario->correo,
            'ip'         => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}