<?php $los = 2; ?>
<?php $tec = 3; ?>
<?php
session_start();
include '../../db.php'; // Conexión a la base de datos

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/instituciones/<?php echo $institucion['logo']; ?>" target="_blank">
    <title> <?php echo $institucion['nombre']; ?> </title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #e2d9b2;
            background-image: url('../../assets/img/a1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body>

    <?php include("../reusable.php"); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>