<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;

class VentaPolicy
{
    // Solo gerente y admin pueden crear ventas
    public function crear(Usuario $auth): bool
    {
        return in_array($auth->rol, ['gerente', 'administrador']);
    }

    // Solo gerente y admin pueden validar ventas
    public function validar(Usuario $auth, Venta $venta): bool
    {
        return in_array($auth->rol, ['gerente', 'administrador']);
    }

    // Cliente solo ve sus ventas, gerente y admin ven todas
    public function ver(Usuario $auth, Venta $venta): bool
    {
        if ($auth->rol === 'cliente') {
            return $auth->id === $venta->cliente_id;
        }
        return true;
    }

    // Solo dueño de la venta, gerente o admin puede ver ticket
    public function verTicket(Usuario $auth, Venta $venta): bool
    {
        return $auth->id === $venta->cliente_id
            || $auth->rol === 'gerente'
            || $auth->rol === 'administrador';
    }

    // Solo admin puede eliminar ventas
    public function eliminar(Usuario $auth, Venta $venta): bool
    {
        return $auth->rol === 'administrador';
    }
}