<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.app')

@section('content')

<h2>Usuarios</h2>

<a href="/users/create" class="btn btn-success mb-3">Crear usuario</a>

<table class="table table-bordered">
<tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Rol</th>
    <th>Acciones</th>
</tr>

@foreach($users as $user)
<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->rol }}</td>
    <td>
        <a href="/users/edit/{{ $user->id }}" class="btn btn-warning btn-sm">Editar</a>
        <a href="/users/delete/{{ $user->id }}" class="btn btn-danger btn-sm">Eliminar</a>
    </td>
</tr>
@endforeach
</table>

@endsection