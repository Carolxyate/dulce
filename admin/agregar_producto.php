<?php
include 'conexion.php';

$nombre = $descripcion = $precio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $target_dir = "img/"; 
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO producto (nombre, descripcion, precio, imagen_url) VALUES ('$nombre', '$descripcion', '$precio', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('Producto agregado exitosamente.');
                    window.location.href = 'index.php'; 
                </script>";
                exit(); 
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Hubo un error subiendo la imagen.');</script>";
        }
    } else {
        echo "<script>alert('El archivo no es una imagen válida.');</script>";
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
    <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required>
        <br>
        <label for="imagen">Subir Imagen:</label>
        <input type="file" name="imagen" accept="img/*" required>
        <br>
        <input type="submit" value="Agregar Producto">
    </form>
</main>
</body>
</html>
