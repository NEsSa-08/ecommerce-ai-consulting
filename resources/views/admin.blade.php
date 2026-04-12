@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Administrador</h2>
    <p>Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Usuarios</h5>
                <a href="/users" class="btn btn-primary mt-2">Gestionar</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Productos</h5>
                <a href="/productos" class="btn btn-success mt-2">Gestionar</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Categorías</h5>
                <a href="/categorias" class="btn btn-warning mt-2">Gestionar</a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card text-center p-3">
                <h5>Ventas</h5>
                <a href="/ventas" class="btn btn-danger mt-2">Gestionar</a>
            </div>
        </div>
    </div>

    <form method="POST" action="/logout" class="mt-4">
        @csrf
        <button class="btn btn-secondary">Cerrar sesión</button>
    </form>
</div>
@endsection