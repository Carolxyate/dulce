<?php
include 'conexion.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $sql = "DELETE FROM compra WHERE carrito_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

header('Location: index.php');
exit();
?>
