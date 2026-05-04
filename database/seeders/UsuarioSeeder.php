<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador fijo
        Usuario::firstOrCreate(
            ['correo' => 'admin@tuxtla.tecnm.mx'],
            [
                'nombre'    => 'Admin',
                'apellidos' => 'Sistema',
                'clave'     => Hash::make('123'),
                'rol'       => 'administrador',
            ]
        );
        // Crear gerente fijo
        Usuario::firstOrCreate(
            ['correo' => 'jlopez@tuxtla.tecnm.mx'],
            [
                'nombre'    => 'Juan',
                'apellidos' => 'Lopez',
                'clave'     => Hash::make('123'),
                'rol'       => 'gerente',
            ]
        );

        // 30 vendedores (gerentes)
        Usuario::factory(30)->create(['rol' => 'gerente']);

        // 70 compradores (clientes)
        Usuario::factory(70)->create(['rol' => 'cliente']);
    }
}