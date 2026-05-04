<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;


// Páginas públicas
Route::get('/', fn() => view('welcome'));
Route::view('/quienes-somos', 'quienes');
Route::view('/contacto', 'contacto');
Route::view('/vision', 'vision');
Route::view('/mision', 'mision');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboards por rol
Route::middleware('auth')->group(function () {
    Route::get('/cliente', fn() => view('cliente'));
    Route::get('/gerente', fn() => view('gerente'));
Route::middleware('auth')->get('/admin/dashboard', [DashboardController::class, 'index']);
});

// CRUD usuarios
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'destroy']);
});
// Rutas de productos
Route::middleware('auth')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::get('/productos/edit/{producto}', [ProductoController::class, 'edit']);
    Route::post('/productos/update/{producto}', [ProductoController::class, 'update']);
    Route::get('/productos/delete/{producto}', [ProductoController::class, 'destroy']);
});
// Rutas de categorías
Route::middleware('auth')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/categorias/create', [CategoriaController::class, 'create']);
    Route::post('/categorias', [CategoriaController::class, 'store']);
    Route::get('/categorias/edit/{categoria}', [CategoriaController::class, 'edit']);
    Route::post('/categorias/update/{categoria}', [CategoriaController::class, 'update']);
    Route::get('/categorias/delete/{categoria}', [CategoriaController::class, 'destroy']);
});

// Rutas de ventas
Route::middleware('auth')->group(function () {
    Route::get('/ventas', [VentaController::class, 'index']);
    Route::get('/ventas/create', [VentaController::class, 'create']);
    Route::post('/ventas', [VentaController::class, 'store']);
    Route::get('/ventas/delete/{venta}', [VentaController::class, 'destroy']);
});
// Rutas 2FA
Route::get('/verificar-codigo', [AuthController::class, 'showVerificarCodigo']);
Route::post('/verificar-codigo', [AuthController::class, 'verificarCodigo']);

Route::middleware('auth')->get('/ventas/ticket/{venta}', [VentaController::class, 'verTicket']);

// Vista de productos para clientes
Route::middleware('auth')->get('/catalogo', [ProductoController::class, 'catalogo']);

// Compra del cliente
Route::middleware('auth')->get('/comprar/{producto}', [VentaController::class, 'comprarForm']);
Route::middleware('auth')->post('/comprar/{producto}', [VentaController::class, 'comprar']);

//validar 
Route::middleware('auth')->post('/ventas/validar/{venta}', [VentaController::class, 'validar']);