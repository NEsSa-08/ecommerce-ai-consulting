<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
{
    return [
        'nombre'      => 'required|string|min:3|max:100|unique:productos,nombre',
        'descripcion' => 'required|string|max:500',
        'precio'      => 'required|numeric|min:0',
        'existencia'  => 'required|integer|min:0',
        'fotos'       => 'nullable|array',
        'fotos.*'     => 'image|mimes:jpg,jpeg,png|max:2048',
    ];
}

    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre del producto es obligatorio.',
            'nombre.unique'        => 'Ya existe un producto con ese nombre.',
            'precio.numeric'       => 'El precio debe ser un número.',
            'precio.min'           => 'El precio no puede ser negativo.',
            'existencia.integer'   => 'La existencia debe ser un número entero.',
        ];
    }
}