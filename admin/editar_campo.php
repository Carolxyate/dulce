<?php
// Incluye el archivo de conexión
include 'conexion.php';

$id = $_GET['id'] ?? '';
$nombre_completo = $telefono = $ciudad = $barrio = $direccion = $email = "";

if ($id) {
    $sql = "SELECT * FROM compra WHERE carrito_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre_completo = $row['nombre_completo'];
        $telefono = $row['telefono'];
        $ciudad = $row['ciudad'];
        $barrio = $row['barrio'];
        $direccion = $row['direccion'];
        $email = $row['email'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    $sql = "UPDATE compra SET nombre_completo='$nombre_completo', telefono='$telefono', ciudad='$ciudad', barrio='$barrio', direccion='$direccion', email='$email' WHERE carrito_id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Registro actualizado exitosamente.";
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
    <title>Editar Registro</title>
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="icon" href="img/logo.png">

</head>
<body>
<header>
        <nav>
            <img class="logo" src="img/logo.png" alt="Logo">
            <h1>EDITAR CAMPOS</h1>
            <h1><a href="index.php">INICIO</a></h1>
            <a href="logout_admin.php">Cerrar sesión</a>

        </nav>
    </header>

    <main>
        <form action="editar_campo.php?id=<?php echo $id; ?>" method="post">
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($nombre_completo); ?>" required>
            <br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
            <br>
            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>" required>
            <br>
            <label for="barrio">Barrio:</label>
            <input type="text" name="barrio" value="<?php echo htmlspecialchars($barrio); ?>" required>
            <br>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <br>
            <input type="submit" value="Actualizar Registro">
        </form>
    </main>
</body>
</html>
