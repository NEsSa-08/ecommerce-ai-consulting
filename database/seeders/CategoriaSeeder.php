<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre'      => 'Electrónica',
                'descripcion' => 'Dispositivos y gadgets electrónicos',
            ],
            [
                'nombre'      => 'Ropa',
                'descripcion' => 'Prendas de vestir para todas las edades',
            ],
            [
                'nombre'      => 'Hogar',
                'descripcion' => 'Artículos para el hogar y decoración',
            ],
            [
                'nombre'      => 'Deportes',
                'descripcion' => 'Equipamiento deportivo y fitness',
            ],
            [
                'nombre'      => 'Alimentos',
                'descripcion' => 'Productos alimenticios y bebidas',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}