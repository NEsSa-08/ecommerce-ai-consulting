<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
{
    // Solo administrador puede crear usuarios
    public function crear(Usuario $auth): bool
    {
        return $auth->rol === 'administrador';
    }

    // Reglas de edición por rol
    public function editar(Usuario $auth, Usuario $objetivo): bool
    {
        // Administrador puede editar a cualquiera
        if ($auth->rol === 'administrador') {
            return true;
        }

        // Gerente solo puede editar clientes
        // No puede editar otros gerentes ni administradores
        if ($auth->rol === 'gerente') {
            return $objetivo->rol === 'cliente';
        }

        return false;
    }

    // Solo administrador puede eliminar
    public function eliminar(Usuario $auth, Usuario $objetivo): bool
    {
        // No puede eliminarse a sí mismo
        if ($auth->id === $objetivo->id) {
            return false;
        }

        return $auth->rol === 'administrador';
    }

    public function verDashboard(Usuario $auth): bool
{
    return $auth->rol === 'administrador';
}

}