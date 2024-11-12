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
    <link rel="stylesheet" href="../src/css/style.css">
    <style>
        /* body {
            font-family: 'Georgia', serif;
            background-color: #7e7b52;
            overflow-x: hidden;
        } */

        body {
            font-family: 'Georgia', serif;
            background-color: #e2d9b2;
            background-image: url('../assets/img/a1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
    <style>
        /* Estilos del sidebar */
        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #070707;
            color: white;
            transition: 0.3s;
            padding-top: 30px;
        }

        #sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 30px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        #sidebar a:hover {
            background-color: #DDDDDD96;
            color: black;
        }

        #sidebar.open {
            left: 0;
        }

        /* Ajustar el contenido cuando el sidebar está abierto */
        #content {
            transition: margin-left 0.3s;
            padding: 20px;
        }

        /* Botón para abrir el sidebar */
        #openBtn {
            font-size: 30px;
            cursor: pointer;
            color: white;
            position: fixed;
            top: 20px;
            left: 20px;
        }

        .row {
            background-color: #000000FF;
        }

        img {
            border-radius: 10%;
        }
    </style>
</head>

<body>
    <!-- Botón para abrir el sidebar -->
    <span id="openBtn">&#9776; Abrir Sidebar</span>

    <!-- Sidebar -->
    <div id="sidebar">
        <a href="javascript:void(0)" id="closeBtn" class="closebtn">&times; Cerrar</a>
        <div class="container text-center">
            <img src="../<?php echo $usuario['foto']; ?>" alt="Foto de Usuario" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            <h2><?php echo $usuario['nombre']; ?></h2>
            <p><strong>Usuario:</strong> <?php echo $usuario['usuario']; ?></p>
            <p><strong>Fecha de Nacimiento:</p>
            <p></strong> <?php echo $usuario['fecha_cumple']; ?></p>
            <img src="../assets/img/instituciones/<?php echo $institucion['logo']; ?>" alt="Logo de Institución" class="img-fluid" style="width: 100px; height: auto; object-fit: cover;">
            <p><?php echo $institucion['nombre']; ?></p>
            <a href="../close"><button class="btn btn-danger" type="button">Cerrar Sesión</button></a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div id="content">
        <div class="container my-5">
            <div class="row p-3 rounded shadow-sm" style="background-color: #FFFDFDAF; color:black">
                <!-- Aquí puede ir más contenido -->
                <h2>Bienvenid@ <?php echo $usuario['nombre']; ?> a la Biblioteca Digital </h2>
                <h2>de la <?php echo $institucion['nombre']; ?> </h2>
                <p>Comencemos a donde quieres ir...</p>
            </div>

            <div class="card-container">
                <div class="card">
                    <span class="card__title">Publicar</span>
                    <p class="card__content">
                        Compartir tus documentos con tu comunidad estudiantil.

                    </p>
                    <form class="card__form" action="@Publicar" method="get">
                        <button type="submit" class="card__button">Click me</button>
                    </form>
                </div>
                <div class="card">
                    <span class="card__title">Repositorio </span>
                    <p class="card__content">
                        Repositorio institucional, de libros, documentación, investigaciones, etc.
                    </p>
                    <form class="card__form" action="@Repositorio" method="get">
                        <button type="submit" class="card__button">Click me</button>
                    </form>
                </div>

                <div class="card">
                    <span class="card__title">Literatura</span>
                    <p class="card__content">
                        Espacio enfocado en la difusión
                        exclusiva de literatura general y de la literatura desarrollada por los estudiantes.
                    </p>
                    <form class="card__form" action="@Literatura">
                        <button type="submit" class="card__button">Click me</button>
                    </form>
                </div>

                <div class="card">
                    <span class="card__title">Proyectos Escolares</span>
                    <p class="card__content">
                        Compendio de proyectos realizados por estudiantes para apoyar a otros estudiantes.
                    </p>
                    <form class="card__form" action="@Proyectos" method="get">
                        <button class="card__button">Click me</button>
                    </form>
                </div>

                <div class="card">
                    <span class="card__title">Mi aportación</span>
                    <p class="card__content">
                        En este apartado puedes revisar tus aportes y para asegurar que los derechos de autor, sean respetados.
                    </p>
                    <form class="card__form" action="@Aportacion" method="get">
                        <button type="submit" class="card__button">Click me</button>
                    </form>
                </div>

                <div class="card">
                    <span class="card__title">Contacto</span>
                    <p class="card__content">
                        Contacto con tu institución o con Historias del tiempo para recibir soporte.
                    </p>
                    <form class="card__form" action="@Contacto" method="get">
                        <button type="submit" class="card__button">Click me</button>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <!-- Agregar el JS de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Abre y cierra el sidebar
        const openBtn = document.getElementById('openBtn');
        const sidebar = document.getElementById('sidebar');
        const closeBtn = document.getElementById('closeBtn');
        const content = document.getElementById('content');

        openBtn.addEventListener('click', () => {
            sidebar.classList.add('open');
            content.style.marginLeft = '250px';
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('open');
            content.style.marginLeft = '0';
        });
    </script>
</body>

</html>

<?php
// Cerrar la conexión
$stmt_usuario->close();
$stmt_institucion->close();
$conn->close();
?>