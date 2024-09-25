<?php
session_start(); 

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    $host = 'localhost';
    $dbname = 'dulceria';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT producto_id, nombre, descripcion, precio, imagen_url FROM producto WHERE producto_id = :producto_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':producto_id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            }

            $encontrado = false;
            
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['producto_id'] == $producto['producto_id']) {
                    $item['cantidad'] += 1;
                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {
                $producto['cantidad'] = 1; 
                $_SESSION['carrito'][] = $producto;
            }

            header("Location: info_carro.php");
            exit();
        } else {
            echo "Producto no encontrado.";
        }

    } catch (PDOException $e) {
        echo "Error en la conexión: " . $e->getMessage();
    }

} else {
    echo "No se ha proporcionado un ID de producto.";
}
?>
