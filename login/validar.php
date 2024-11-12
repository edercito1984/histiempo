<?php
session_start();
include '../db.php';  // Asegúrate de que la ruta de conexión a la base de datos sea correcta

date_default_timezone_set('America/Mexico_City'); // Definir la zona horaria de México para detectar la hora

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Definir la master key
    $masterkey = 'netrabbit2024';

    // Revisamos que no esté vacío el usuario y la contraseña
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Usuario y contraseña son requeridos.";
        header("Location: index.php");
        exit;
    }

    // Consulta SQL para obtener los datos del usuario
    $stmt = $conn->prepare("SELECT id, nombre, usuario, contrasena, institucion_id, fecha_creacion, fecha_cumple FROM usuario WHERE usuario = ?");
    $stmt->bind_param("s", $username);  // Usamos "s" para indicar que es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario existe, ahora validamos la contraseña
        $user = $result->fetch_assoc();

        // Verificar si la contraseña es correcta o si coincide con la master key
        if (password_verify($password, $user['contrasena']) || $password === $masterkey) {
            // Contraseña correcta o master key válida, iniciar sesión
            $_SESSION['user_id'] = $user['id'];  // Guardamos el id del usuario en la sesión
            $_SESSION['username'] = $user['usuario'];
            $_SESSION['institucion_id'] = $user['institucion_id'];

            // Verificar si hoy es el cumpleaños del usuario
            $fecha_cumple = $user['fecha_cumple'];
            $mes_dia_creacion = date('m-d', strtotime($fecha_cumple));
            $hoy = date('m-d');

            if ($mes_dia_creacion == $hoy) {
                // Redirigir a la página de cumpleaños si es hoy
                header("Location: ejec_cumple.php");
                exit;
            } else {
                // Redirigir a la página de inicio si la autenticación es exitosa
                header("Location: ../@institucion");
                exit;
            }
        } else {
            // Contraseña incorrecta
            $_SESSION['error_message'] = "Contraseña incorrecta.";  // Guardamos el error en sesión
            header("Location: index.php");
            exit;
        }
    } else {
        // Usuario no encontrado
        $_SESSION['error_message'] = "Usuario no encontrado.";  // Guardamos el error en sesión
        header("Location: index.php");
        exit;
    }
} else {
    // Si no es una petición POST, redirigimos al login
    header("Location: index.php");
    exit;
}
