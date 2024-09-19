<?php
include 'conexion.php';

$nombre = $descripcion = $precio = $imagen_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_url = $_POST['imagen_url'];

    $sql = "INSERT INTO producto (nombre, descripcion, precio, imagen_url) VALUES ('$nombre', '$descripcion', '$precio', '$imagen_url')";
    if (mysqli_query($conn, $sql)) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="icon" href="img/logo.png">

</head>
<body>
<header>
        <nav>
            <img class="logo" src="img/logo.png" alt="Logo">
            <h1>AGREGAR PRODUCTOS</h1>
            <h1><a href="index.php">INICIO</a></h1>
            <a href="logout_admin.php">Cerrar sesión</a>

        </nav>
    </header>

    <main>
        <form action="agregar_producto.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
            <br>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" required>
            <br>
            <label for="precio">Precio:</label>
            <input type="number" name="precio" step="0.01" required>
            <br>
            <label for="imagen_url">URL de Imagen:</label>
            <input type="text" name="imagen_url" required>
            <br>
            <input type="submit" value="Agregar Producto">
        </form>
    </main>
</body>
</html>
