<?php
include 'conexion.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $sql = "DELETE FROM producto WHERE producto_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

header('Location: index.php');
exit();
?>
