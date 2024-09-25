<?php
include 'conexion.php';

$id = $_GET['id'] ?? '';
$nombre = $descripcion = $precio = $imagen_url = "";

if ($id) {
    $sql = "SELECT * FROM producto WHERE producto_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $imagen_url = $row['imagen_url'];
    }
}

$mensaje_exito = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if (!empty($_FILES["imagen"]["name"])) {
        $target_dir = "img/"; 
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $imagen_url = $target_file;
            } else {
                echo "<script>alert('Hubo un error subiendo la imagen.');</script>";
            }
        } else {
            echo "<script>alert('El archivo no es una imagen.');</script>";
        }
    }

    $sql = "UPDATE producto SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen_url='$imagen_url' WHERE producto_id=$id";
    if (mysqli_query($conn, $sql)) {
        $mensaje_exito = "Producto actualizado exitosamente."; 
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="icon" href="img/logo.png">
    <script>
        function mostrarAlerta(mensaje) {
            if (mensaje) {
                alert(mensaje); 
            }
        }
    </script>
</head>
<body onload="mostrarAlerta('<?php echo $mensaje_exito; ?>')">
<header>
    <nav>
        <img class="logo" src="img/logo.png" alt="Logo">
        <h1>EDITAR PRODUCTO</h1>
        <h1><a href="index.php">INICIO</a></h1>
        <a href="logout_admin.php">Cerrar sesión</a>
    </nav>
</header>

<main>
    <form action="editar_producto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>" required>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="<?php echo htmlspecialchars($precio); ?>" step="0.01" required>
        <br>
        <label for="imagen_actual">Imagen Actual:</label>
        <br>
        <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="Imagen del Producto" width="150">
        <br>
        <label for="imagen">Subir Nueva Imagen (opcional):</label>
        <input type="file" name="imagen" accept="img/*">
        <br>
        <input type="submit" value="Actualizar Producto">
    </form>
</main>
</body>
</html>

