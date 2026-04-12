<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        // Ignorar el unique del producto actual al editar
        $productoId = $this->route('producto')->id;

        return [
            'nombre'      => "required|string|min:3|max:100|unique:productos,nombre,{$productoId}",
            'descripcion' => 'required|string|max:500',
            'precio'      => 'required|numeric|min:0',
            'existencia'  => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre del producto es obligatorio.',
            'nombre.unique'      => 'Ya existe un producto con ese nombre.',
            'precio.numeric'     => 'El precio debe ser un número.',
            'existencia.integer' => 'La existencia debe ser un número entero.',
        ];
    }
}