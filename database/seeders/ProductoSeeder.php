<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Tomamos el gerente como vendedor
        $vendedor = Usuario::where('rol', 'gerente')->first();

        $productos = [
            [
                'nombre'      => 'Laptop HP',
                'descripcion' => 'Laptop HP 15 pulgadas, 8GB RAM',
                'precio'      => 12000.00,
                'existencia'  => 10,
            ],
            [
                'nombre'      => 'Tenis Nike',
                'descripcion' => 'Tenis deportivos talla 27',
                'precio'      => 1500.00,
                'existencia'  => 25,
            ],
            [
                'nombre'      => 'Silla de oficina',
                'descripcion' => 'Silla ergonómica con soporte lumbar',
                'precio'      => 3500.00,
                'existencia'  => 8,
            ],
            [
                'nombre'      => 'Balón de fútbol',
                'descripcion' => 'Balón oficial tamaño 5',
                'precio'      => 450.00,
                'existencia'  => 30,
            ],
        ];

        foreach ($productos as $data) {
            $producto = Producto::create([
                ...$data,
                'usuario_id' => $vendedor->id,
            ]);

            // Asignar 1 o 2 categorías aleatorias a cada producto
            $categorias = Categoria::inRandomOrder()->take(2)->pluck('id');
            $producto->categorias()->attach($categorias);
        }
    }
}