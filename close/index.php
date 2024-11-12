<?php
session_start();  // Iniciar sesión

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: ../login");
exit;
