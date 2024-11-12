<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .body {
            background-color: #000000;
        }

        /* Estilo para el carrusel de fondo */
        .carousel-item img {
            height: 100vh;
            object-fit: cover;
            filter: brightness(80%);
        }

        /* Estilos para el contenedor de login */
        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #FFFFFFB7;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0px 5px 20px #00E1FFFF;
            animation: fadeIn 1.5s ease;
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Colores y estilo alegre */
        .login-container h2 {
            color: #0A1CC2FF;
            font-weight: bold;
            text-align: center;
        }

        .form-control:focus {
            box-shadow: 0 0 8px #0011FFFF;
        }

        /* Botón */
        .btn-login {
            background-color: #0011FFFF;
            color: white;
            border: none;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #1A2075FF;
            color: #ffffff;
        }

        /* Estilo para el checkbox */
        .checkbox-label {
            color: #0011FFFF;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Carrusel de fondo -->
    <div id="backgroundCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/1.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="assets/img/2.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="assets/img/3.jpg" class="d-block w-100" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="assets/img/4.jpg" class="d-block w-100" alt="Image 3">
            </div>
        </div>
    </div>

    <!-- Contenedor de login -->
    <div class="login-container">
        <h2>Login</h2>
        <form action="home.php" method="POST">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group position-relative">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <i class="toggle-password fas fa-lock" onclick="togglePassword()"></i>
            </div>

            <!-- Checkbox para mostrar la contraseña -->
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePasswordVisibility()">
                    <label class="form-check-label checkbox-label" for="showPassword">Mostrar contraseña</label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">Ingresar</button>
        </form>
    </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Para los iconos de FontAwesome -->

    <script>
        // Función para mostrar y ocultar la contraseña
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-lock");
                icon.classList.add("fa-lock-open");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-lock-open");
                icon.classList.add("fa-lock");
            }
        }

        // Función para cambiar la visibilidad de la contraseña cuando se marca el checkbox
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("showPassword");

            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>