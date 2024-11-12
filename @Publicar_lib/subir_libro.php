<?php
// Incluye la conexión a la base de datos
include '../db.php';

// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['institucion_id'])) {
    $_SESSION['error_message'] = "Debe iniciar sesión para subir un libro.";
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $fecha_subida = date("Y-m-d H:i:s");

    // Rutas de destino
    $pdf_path = null;
    $img_path = null;

    // Manejo del archivo PDF
    if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] == UPLOAD_ERR_OK) {
        $pdf_path = '../assets/libros/' . basename($_FILES['archivo_pdf']['name']);
        if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $pdf_path)) {
            echo "PDF subido con éxito.<br>";
            $pdf_path = 'assets/libros/' . basename($_FILES['archivo_pdf']['name']); // Guarda ruta relativa
        } else {
            echo "Error al mover el archivo PDF.<br>";
            $pdf_path = null;
        }
    } else {
        echo "Error al subir el archivo PDF: " . $_FILES['archivo_pdf']['error'] . "<br>";
    }

    // Manejo de la imagen del libro
    if (isset($_FILES['foto_libro']) && $_FILES['foto_libro']['error'] == UPLOAD_ERR_OK) {
        $img_path = '../assets/img/libros/' . basename($_FILES['foto_libro']['name']);
        if (move_uploaded_file($_FILES['foto_libro']['tmp_name'], $img_path)) {
            echo "Imagen subida con éxito.<br>";
            $img_path = 'assets/img/libros/' . basename($_FILES['foto_libro']['name']); // Guarda ruta relativa
        } else {
            echo "Error al mover la imagen.<br>";
            $img_path = null;
        }
    } else {
        echo "Error al subir la imagen: " . $_FILES['foto_libro']['error'] . "<br>";
    }

    // Insertar en la base de datos solo si se subió al menos un archivo
    if ($pdf_path || $img_path) {
        $stmt = $conn->prepare("INSERT INTO libros (nombre, descripcion, archivo_pdf, foto_libro, fecha_subida, institucion_id, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $nombre, $descripcion, $pdf_path, $img_path, $fecha_subida, $_SESSION['institucion_id'], $_SESSION['user_id']);

        if ($stmt->execute()) {
            echo "Libro subido exitosamente.";
        } else {
            echo "Error al guardar la información del libro en la base de datos.";
        }

        $stmt->close();
    } else {
        echo "No se subieron archivos válidos.";
    }

    // Cierra la conexión
    $conn->close();
}
