<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;

class VentaPolicy
{
    // Clientes y gerentes pueden crear ventas
    public function crear(Usuario $auth): bool
    {
        return in_array($auth->rol, ['cliente', 'gerente', 'administrador']);
    }

    // Solo administrador puede eliminar ventas
    public function eliminar(Usuario $auth, Venta $venta): bool
    {
        return $auth->rol === 'administrador';
    }
}