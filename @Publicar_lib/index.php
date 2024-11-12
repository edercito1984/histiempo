<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Subir Libro</title>
</head>

<body>
    <h2>Subir un nuevo libro</h2>
    <form action="subir_libro.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del libro:</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea><br><br>

        <label for="archivo_pdf">Archivo PDF:</label>
        <input type="file" name="archivo_pdf" id="archivo_pdf" accept="application/pdf" required><br><br>

        <label for="foto_libro">Foto del libro:</label>
        <input type="file" name="foto_libro" id="foto_libro" accept="image/*" required><br><br>

        <button type="submit">Subir Libro</button>
    </form>
</body>

</html>