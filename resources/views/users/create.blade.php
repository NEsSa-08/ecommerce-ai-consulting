<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Crear Usuario</h1>

<form method="POST" action="/users">
    @csrf

    <input type="text" name="name" placeholder="Nombre"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>

    <select name="rol">
        <option value="cliente">Cliente</option>
        <option value="empleado">Empleado</option>
        <option value="gerente">Gerente</option>
    </select><br>

    <button>Guardar</button>
</form>