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

// Consultar los libros de la institución
$query_libros = "SELECT nombre, foto_libro, archivo_pdf FROM libros WHERE institucion_id = ?";
$stmt_libros = $conn->prepare($query_libros);
$stmt_libros->bind_param("i", $institucion_id);
$stmt_libros->execute();
$result_libros = $stmt_libros->get_result();

// Obtener los libros en un array
$libros = [];
while ($libro = $result_libros->fetch_assoc()) {
    $libros[] = $libro;
}

// Paginación
$libros_por_pagina = 2;  // Número de libreros por página
$total_libreros = ceil(count($libros) / 6);  // Número total de libreros (cada uno contiene 6 libros)
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $libros_por_pagina; // Inicio de los libreros para la página actual
$libreros_pagina = array_slice($libros, $inicio * 6, $libros_por_pagina * 6); // Libros de la página actual
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/instituciones/<?php echo $institucion['logo']; ?>" target="_blank">
    <title><?php echo $institucion['nombre']; ?></title>
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

        .libreros-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .librero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 48%;
            margin-bottom: 30px;
            margin-left: 20px;
            padding: 10px;
        }

        .libros {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .libro-item {
            width: 30%;
            margin-bottom: 20px;
            text-align: center;
        }

        .libro {
            width: 100%;
            height: auto;
        }

        .estante {
            width: 100%;
            height: 10px;
            background-color: #333;
            margin: 15px 0;
        }

        .pagination {
            justify-content: center;
            display: flex;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php include("../reusable.php"); ?>

    <div>
        <h1 style="color:white; text-align:center; margin-top: 20px;">Librería: <?php echo $institucion['nombre']; ?></h1>
    </div>

    <div class="container-1">
        <div class="libreros-container">
            <?php
            $libreros = array_chunk($libreros_pagina, 6);
            foreach ($libreros as $librero) {
                echo '<div class="librero">';
                echo '<div class="libros">';
                foreach ($librero as $key => $libro) {
                    $pdf_url = isset($libro['archivo_pdf']) && !empty($libro['archivo_pdf']) ? '../../' . $libro['archivo_pdf'] : '#';

                    echo '<div class="libro-item">';
                    echo '<a href="' . $pdf_url . '" target="_blank">'; // Enlace a abrir el PDF en una nueva pestaña
                    echo '<img src="../../' . $libro['foto_libro'] . '" class="libro" alt="Libro">';
                    echo '</a>';
                    echo '<p style="color: white;">' . $libro['nombre'] . '</p>';
                    echo '</div>';
                    if (($key + 1) % 3 == 0 && $key + 1 != count($librero)) {
                        echo '<div class="estante"></div>';
                    }
                }
                echo '<div>';
                echo '<h1 style="font-size: 18px; color: white; margin-top: auto;">By: Historias del Tiempo</h1>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Paginación -->
        <div class="pagination">
            <?php
            $total_paginas = ceil($total_libreros / $libros_por_pagina);
            if ($pagina_actual > 1) {
                echo '<a href="?pagina=' . ($pagina_actual - 1) . '" class="btn btn-primary">Anterior</a>';
            }
            if ($pagina_actual < $total_paginas) {
                echo '<a href="?pagina=' . ($pagina_actual + 1) . '" class="btn btn-primary">Siguiente</a>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>