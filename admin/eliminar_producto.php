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
<?php
include 'conexion.php';

$id = $_GET['id'] ?? '';
$mensaje_exito = ""; 

if ($id) {
    $sql = "DELETE FROM producto WHERE producto_id = $id";
    if (mysqli_query($conn, $sql)) {
        $mensaje_exito = "Producto eliminado exitosamente."; 
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

echo "<script>
    alert('$mensaje_exito');
    window.location.href = 'index.php';
</script>";

exit();
?>
