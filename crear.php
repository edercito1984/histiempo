<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>

<body>

    <h2>Crear Nuevo Usuario</h2>

    <!-- Formulario para ingresar datos -->
    <form action="crear_usuario.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <label for="institucion_id">Institución ID:</label>
        <input type="number" id="institucion_id" name="institucion_id" required><br><br>

        <label for="fecha_cumple">Fecha de Cumpleaños:</label>
        <input type="date" id="fecha_cumple" name="fecha_cumple"><br><br>

        <label for="foto">Foto de Perfil:</label>
        <input type="file" id="foto" name="foto" accept="image/*"><br><br>

        <button type="submit" name="crear_usuario">Crear Usuario</button>
    </form>

</body>

</html>