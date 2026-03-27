<?php

use App\Http\Controllers\AuthController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// Registro
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboards
Route::get('/cliente', function () {
    return view('cliente');
})->middleware('auth');

Route::get('/empleado', function () {
    return view('empleado');
})->middleware('auth');

Route::get('/gerente', function () {
    return view('gerente');
})->middleware('auth');

// Páginas públicas (sin login)
Route::view('/quienes-somos', 'quienes');
Route::view('/contacto', 'contacto');
Route::view('/vision', 'vision');
Route::view('/mision', 'mision');

use App\Http\Controllers\UserController;

// CRUD usuarios
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'destroy']);
});
