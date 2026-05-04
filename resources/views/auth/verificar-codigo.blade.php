@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <div style="font-size: 48px;">🔐</div>
                    <h4 style="font-weight: 700; color: #1e293b;">Verificación en dos pasos</h4>
                    <p style="color: #64748b; font-size: 0.9rem;">
                        Ingresa el código de 6 dígitos que enviamos a tu correo.
                    </p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="/verificar-codigo">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Código de verificación</label>
                        <input type="text" name="codigo" maxlength="6"
                               class="form-control text-center @error('codigo') is-invalid @enderror"
                               style="font-size: 24px; font-weight: 700; letter-spacing: 8px;"
                               placeholder="000000" autocomplete="off">
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Verificar</button>
                    <a href="/login" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                </form>

                <p class="text-center mt-3" style="font-size: 0.8rem; color: #94a3b8;">
                    ⏱ El código expira en 5 minutos
                </p>
            </div>
        </div>
    </div>
</div>
@endsection