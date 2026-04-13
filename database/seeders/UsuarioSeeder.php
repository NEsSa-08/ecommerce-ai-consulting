<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Crear administrador fijo
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

        // Generar 5 usuarios aleatorios con la factory
        Usuario::factory(5)->create();
    }
}