<?php

// Incluye la conexión a la base de datos
include('db.php');

// Verifica si el formulario fue enviado
if (isset($_POST['crear_usuario'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);
    $institucion_id = mysqli_real_escape_string($conn, $_POST['institucion_id']);
    $fecha_cumple = mysqli_real_escape_string($conn, $_POST['fecha_cumple']);

    // Manejo de foto de perfil
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Define la ruta correcta
        $foto = 'assets/img/user/' . basename($_FILES['foto']['name']);

        // Mueve el archivo a la ubicación correcta
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
            echo "Imagen subida con éxito.";
        } else {
            echo "Error al subir la imagen.";
            $foto = null;
        }
    } else {
        $foto = null; // Si no se sube foto, se deja como null
    }

    // Encriptar la contraseña
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO usuario (nombre, usuario, contrasena, institucion_id, fecha_creacion, fecha_cumple, foto) 
            VALUES ('$nombre', '$usuario', '$contrasena_hash', '$institucion_id', NOW(), '$fecha_cumple', '$foto')";

    if (mysqli_query($conn, $sql)) {
        echo "Usuario creado con éxito.";
        header("Location: login"); // Redirige a la página de usuarios
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Cierra la conexión
    mysqli_close($conn);
}
