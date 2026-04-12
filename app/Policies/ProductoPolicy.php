<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Producto;

class ProductoPolicy
{
    // Administrador y gerente pueden crear productos
    public function crear(Usuario $auth): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    // Administrador puede editar cualquier producto
    // Gerente solo puede editar sus propios productos
    public function editar(Usuario $auth, Producto $producto): bool
    {
        if ($auth->rol === 'administrador') {
            return true;
        }

        if ($auth->rol === 'gerente') {
            return $producto->usuario_id === $auth->id;
        }

        return false;
    }

    // Solo administrador puede eliminar productos
    public function eliminar(Usuario $auth, Producto $producto): bool
    {
        return $auth->rol === 'administrador';
    }

    // Cualquier usuario autenticado puede ver productos
    public function ver(Usuario $auth): bool
    {
        return true;
    }
}