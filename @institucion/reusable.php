<!-- ////////RUTAS///////// -->
<?php
if ($los == 1) {
    $los = "";
} elseif ($los == 2) {
    $los = "../";
} elseif ($los == 3) {
    $los = "../../";
} elseif ($los == 4) {
    $los = "../../../";
} else {
    $los = "../";
}
?>

<?php
if ($tec == 1) {
    $tec = "";
} elseif ($tec == 2) {
    $tec = "../";
} elseif ($tec == 3) {
    $tec = "../..";
} elseif ($tec == 4) {
    $tec = "../../../";
} else {
    $tec = "../";
}
?>









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

    /* Estilo para el navbar */
    nav {
        background-color: #333;
    }

    nav a {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
    }

    nav a:hover {
        background-color: #555;
    }

    /* Estilo para la foto del usuario dentro del navbar */
    .navbar-brand {
        display: flex;
        align-items: center;
        margin-left: 20px;
    }

    #openBtn {
        font-size: 30px;
        cursor: pointer;
        position: absolute;
        left: 15px;
    }

    #openBtn img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid #fff;
        transition: transform 0.3s ease;
    }

    #openBtn img:hover {
        transform: scale(1.1);
    }

    .navbar-nav {
        flex-grow: 1;
        justify-content: center;
    }

    /* Estilos responsivos para móviles */
    .container-1 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        /* margin-top: 80px; */
    }

    .librero {
        width: 100%;
        max-width: 350px;
        background-color: #9E5B40;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        padding: 20px;
        /* margin: 10px; */
    }

    .estante {
        background-color: #EB8227FF;
        height: 10px;
        margin-bottom: 30px;
        border-radius: 8px;
    }

    .libros {
        display: flex;
        justify-content: space-evenly;
        align-items: flex-start;
        gap: 10px;
    }

    .libro {
        width: 60px;
        height: 100px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .libro:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    /* Asegurarse de que las imágenes de perfil y logo no sean demasiado grandes en móviles */
    #openBtn img,
    #sidebar img {
        max-width: 100px;
        max-height: 100px;
    }

    /* Para pantallas pequeñas, ajustamos el sidebar */
    @media (max-width: 768px) {
        #sidebar {
            width: 200px;
        }

        .container-1 {
            flex-direction: column;
        }

        .librero {
            width: 80%;
            margin-bottom: 20px;
        }

        nav {
            padding: 10px 0;
        }

        .navbar-nav {
            display: block;
            text-align: center;
        }

        .navbar-nav .nav-item {
            margin: 5px 0;
        }
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <div class="navbar-brand">
            <!-- Foto del usuario -->
            <span id="openBtn">
                <img src="<?php echo $tec; ?>/<?php echo $usuario['foto']; ?>" alt="Foto de Usuario">
            </span>

        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>@Publicar">Publicar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>@Literatura">Literatura</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>@Proyectos">Proyectos Escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>@Aportacion">Mi aportación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $los; ?>@Contacto">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="sidebar">
    <!-- Botón para cerrar el sidebar -->
    <a href="javascript:void(0)" id="closeBtn" class="closebtn">&times; Cerrar</a>

    <!-- Contenedor del usuario e institución -->
    <div class="container text-center">
        <!-- Foto de Usuario -->
        <img src="<?php echo $tec; ?>/<?php echo $usuario['foto']; ?>" alt="Foto de Usuario" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">

        <!-- Información del Usuario -->
        <h2><?php echo $usuario['nombre']; ?></h2>
        <p><strong>Usuario:</strong> <?php echo $usuario['usuario']; ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?php echo $usuario['fecha_cumple']; ?></p>

        <!-- Logo de Institución -->
        <img src="<?php echo $tec; ?>/assets/img/instituciones/<?php echo $institucion['logo']; ?>" alt="Logo de Institución" class="img-fluid" style="width: 100px; height: auto; object-fit: cover;">
        <p><?php echo $institucion['nombre']; ?></p>

        <!-- Botón de Cerrar Sesión -->
        <form action="<?php echo $los; ?>/close" method="post">
            <button class="btn btn-danger" type="submit">Cerrar Sesión</button>
        </form>
    </div>
</div>





<script>
    // Función para abrir el sidebar
    function openNav() {
        document.getElementById("sidebar").style.left = "0";
    }

    // Función para cerrar el sidebar
    function closeNav() {
        document.getElementById("sidebar").style.left = "-250px";
    }

    // Agregar el evento de apertura del sidebar
    document.getElementById("openBtn").addEventListener("click", openNav);

    // Agregar el evento de cierre del sidebar
    document.getElementById("closeBtn").addEventListener("click", closeNav);
</script>