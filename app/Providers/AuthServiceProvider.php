<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use App\Policies\ProductoPolicy;
use App\Policies\UsuarioPolicy;
use App\Policies\VentaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Usuario::class => UsuarioPolicy::class,
        Producto::class => ProductoPolicy::class,
        Venta::class => VentaPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}