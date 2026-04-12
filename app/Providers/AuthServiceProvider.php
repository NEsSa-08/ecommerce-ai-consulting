<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use App\Policies\ProductoPolicy;
use App\Policies\UsuarioPolicy;
use App\Policies\VentaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Categoria;
use App\Policies\CategoriaPolicy;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Usuario::class => UsuarioPolicy::class,
        Producto::class => ProductoPolicy::class,
        Venta::class => VentaPolicy::class,
        Categoria::class => CategoriaPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}