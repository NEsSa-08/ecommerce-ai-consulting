<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes  = Usuario::where('rol', 'cliente')->get();
        $productos = Producto::all();

        // Generar 150 ventas aleatorias
        for ($i = 0; $i < 150; $i++) {
            $producto = $productos->random();
            $cliente  = $clientes->random();

            Venta::create([
                'producto_id' => $producto->id,
                'vendedor_id' => $producto->usuario_id,
                'cliente_id'  => $cliente->id,
                'fecha'       => now()->subDays(rand(0, 90))->toDateString(),
                'total'       => $producto->precio,
                'ticket'      => null,
                'validada'    => rand(0, 1),
            ]);
        }
    }
}