<?php
session_start(); // Iniciar la sesión

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Carrito de Compras</h1>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_carrito = 0;
        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $total_producto = $producto['precio'] * $producto['cantidad'];
            $total_carrito += $total_producto;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td>$<?php echo number_format($total_producto, 2); ?></td>
                <td>
                    <a href="eliminar_producto.php?id=<?php echo $id_producto; ?>">Eliminar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<p><strong>Total del carrito:</strong> $<?php echo number_format($total_carrito, 2); ?></p>

<a href="productos.php">Seguir comprando</a>

</body>
</html>
