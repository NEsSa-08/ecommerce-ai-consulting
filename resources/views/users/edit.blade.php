<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Editar Usuario</h1>

<form method="POST" action="/users/update/{{ $user->id }}">
    @csrf

    <input type="text" name="name" value="{{ $user->name }}"><br>
    <input type="email" name="email" value="{{ $user->email }}"><br>

    <select name="rol">
        <option value="cliente" {{ $user->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
        <option value="empleado" {{ $user->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
        <option value="gerente" {{ $user->rol == 'gerente' ? 'selected' : '' }}>Gerente</option>
    </select><br>

    <button>Actualizar</button>
</form>