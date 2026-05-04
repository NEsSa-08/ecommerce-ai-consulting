<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
{
    return [
        'producto_id' => 'required|integer|exists:productos,id',
        'cliente_id'  => 'required|integer|exists:usuarios,id',
        'fecha'       => 'required|date',
        'ticket'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];
}

    public function messages(): array
    {
        return [
            'producto_id.required' => 'Debes seleccionar un producto.',
            'producto_id.exists'   => 'El producto seleccionado no existe.',
            'cliente_id.required'  => 'Debes seleccionar un cliente.',
            'cliente_id.exists'    => 'El cliente seleccionado no existe.',
            'fecha.required'       => 'La fecha es obligatoria.',
            'fecha.date'           => 'La fecha no tiene un formato válido.',
        ];
    }
    
}

