<?php
session_start();
include '../db.php'; // Conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login"); // Redirigir a la página de login si no está logueado
    exit;
}

// Obtener el id del usuario de la sesión
$id_usuario = $_SESSION['user_id'];  // Usamos 'user_id' que fue guardado al hacer login

// Consultar la información del usuario
$query_usuario = "SELECT * FROM usuario WHERE id = ?";
$stmt_usuario = $conn->prepare($query_usuario);
$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();

// Consultar la información de la institución asociada al usuario
$institucion_id = $usuario['institucion_id'];
$query_institucion = "SELECT * FROM institucion WHERE id = ?";
$stmt_institucion = $conn->prepare($query_institucion);
$stmt_institucion->bind_param("i", $institucion_id);
$stmt_institucion->execute();
$result_institucion = $stmt_institucion->get_result();
$institucion = $result_institucion->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="../assets/img/instituciones/<?php echo $institucion['logo']; ?>" target="_blank">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $institucion['nombre']; ?></title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Georgia', serif;
            /* Tipografía más tradicional */
            background-color: #5f7f7a;
            /* Fondo suave y cálido */
        }

        .row {
            background-color: #e2d9b2;
            /* Fondo del banner en color beige */
        }

        /* h2,
        p {
            color: #3c2a21;
           
        }

        */
        img {
            border-radius: 10%;
            /* Bordes más suaves */
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <!-- Banner con imagen y datos del usuario e institución bg-black-->
        <div class="row  p-3 rounded shadow-sm" style="background-color: #070707AF; color:white">
            <!-- Foto del usuario -->
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <img src="../assets/img/<?php echo $usuario['foto']; ?>" alt="Foto de Usuario" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            </div>

            <!-- Información del usuario -->
            <div class="col-12 col-md-6">
                <h2><?php echo $usuario['nombre']; ?></h2>
                <p><strong>Usuario:</strong> <?php echo $usuario['usuario']; ?></p>
                <p><strong>Fecha de Cumpleaños:</strong> <?php echo $usuario['fecha_cumple']; ?></p>
            </div>

            <!-- Información de la institución -->
            <div class="col-12 col-md-3 text-center text-md-end">
                <img src="../assets/img/instituciones/<?php echo $institucion['logo']; ?>" alt="Logo de Institución" class="img-fluid" style="width: 100px; height: auto; object-fit: cover;">
                <p><?php echo $institucion['nombre']; ?></p>

            </div>
        </div>
    </div>

    <!-- Agregar el JS de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$stmt_usuario->close();
$stmt_institucion->close();
$conn->close();
?>