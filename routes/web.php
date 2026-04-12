<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/admin/dashboard', fn() => view('admin'));
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