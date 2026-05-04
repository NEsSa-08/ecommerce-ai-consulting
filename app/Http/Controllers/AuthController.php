<?php

namespace App\Http\Controllers;

use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // ── Mostrar formulario de login ──
    public function showLogin()
    {
        return view('auth.login');
    }

    // ── Fase 1: Verificar credenciales y enviar código ──
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credenciales = [
            'correo'   => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credenciales)) {
            $usuario = Auth::user();

            // Cerrar sesión temporalmente hasta que valide el código
            Auth::logout();

            Log::channel('autenticacion')->info('Login fase 1 correcto', [
                'usuario_id' => $usuario->id,
                'correo'     => $usuario->correo,
                'ip'         => $request->ip(),
            ]);

            // Invalidar códigos anteriores
            CodigoVerificacion::where('usuario_id', $usuario->id)
                ->where('usado', false)
                ->update(['usado' => true]);

            // Generar código de 6 dígitos
            $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Guardar en base de datos con expiración de 5 minutos
            CodigoVerificacion::create([
                'usuario_id' => $usuario->id,
                'codigo'     => $codigo,
                'expiracion' => Carbon::now()->addMinutes(5),
                'usado'      => false,
            ]);

            Log::channel('autenticacion')->info('Codigo 2FA generado', [
                'usuario_id' => $usuario->id,
                'ip'         => $request->ip(),
            ]);

            // Enviar código por correo
            Mail::to($usuario->correo)->send(
                new CodigoVerificacionMail($codigo, $usuario->nombre)
            );

            // Guardar usuario_id en sesión para fase 2
            session(['2fa_usuario_id' => $usuario->id]);

            return redirect('/verificar-codigo');
        }

        Log::channel('autenticacion')->warning('Login fallido', [
            'correo' => $request->email,
            'ip'     => $request->ip(),
        ]);

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // ── Mostrar formulario de código ──
    public function showVerificarCodigo()
    {
        if (!session('2fa_usuario_id')) {
            return redirect('/login');
        }
        return view('auth.verificar-codigo');
    }

    // ── Fase 2: Validar código OTP ──
    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => 'required|digits:6',
        ]);

        $usuarioId = session('2fa_usuario_id');

        if (!$usuarioId) {
            return redirect('/login')->withErrors(['codigo' => 'Sesión expirada. Inicia sesión nuevamente.']);
        }

        $registro = CodigoVerificacion::where('usuario_id', $usuarioId)
            ->where('usado', false)
            ->latest()
            ->first();

        if (!$registro) {
            return back()->withErrors(['codigo' => 'Código no encontrado.']);
        }

        // Verificar si expiró
        if ($registro->estaExpirado()) {
            Log::channel('autenticacion')->warning('Codigo 2FA expirado', [
                'usuario_id' => $usuarioId,
                'ip'         => $request->ip(),
            ]);
            return back()->withErrors(['codigo' => 'El código ha expirado. Inicia sesión nuevamente.']);
        }

        // Verificar si el código es correcto
        if ($registro->codigo !== $request->codigo) {
            Log::channel('autenticacion')->warning('Codigo 2FA invalido', [
                'usuario_id' => $usuarioId,
                'ip'         => $request->ip(),
            ]);
            return back()->withErrors(['codigo' => 'Código incorrecto.']);
        }

        // Marcar código como usado
        $registro->update(['usado' => true]);

        // Iniciar sesión
        $usuario = Usuario::findOrFail($usuarioId);
        Auth::login($usuario);
        session()->forget('2fa_usuario_id');
        $request->session()->regenerate();

        Log::channel('autenticacion')->info('Codigo 2FA validado correctamente', [
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

    // ── Registro ──
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

    // ── Logout ──
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