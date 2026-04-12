<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $usuarioId = $this->route('id');

        return [
            'nombre'    => 'required|string|min:2|max:100',
            'apellidos' => 'required|string|min:2|max:100',
            'correo'    => "required|email|unique:usuarios,correo,{$usuarioId}",
            'rol'       => 'required|string|in:administrador,gerente,cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'rol.in'             => 'El rol debe ser administrador, gerente o cliente.',
        ];
    }
}