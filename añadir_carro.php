<?php
// Iniciar sesión
session_start();

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Conexión a la base de datos
    $host = 'localhost';
    $dbname = 'dulceria';
    $username = 'root';
    $password = '';

    try {
        // Crear una nueva instancia de PDO (PHP Data Objects)
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        // Configurar PDO para lanzar excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para traer los detalles del producto con el id correspondiente
        $query = "SELECT producto_id, nombre, descripcion, precio, imagen_url FROM producto WHERE producto_id = :producto_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':producto_id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch del producto como un array asociativo
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            echo "Producto no encontrado.";
            exit;
        }

        // Añadir el producto al carrito si se hace clic en "Añadir al carrito"
        if (isset($_GET['action']) && $_GET['action'] == 'add') {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Verificar si el producto ya está en el carrito
            $producto_encontrado = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['producto_id'] == $producto['producto_id']) {
                    $item['cantidad'] += 1;  // Incrementar cantidad si ya está en el carrito
                    $producto_encontrado = true;
                    break;
                }
            }

            // Si el producto no está en el carrito, añadirlo
            if (!$producto_encontrado) {
                $_SESSION['carrito'][] = [
                    'producto_id' => $producto['producto_id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => 1
                ];
            }

            // Redireccionar para evitar añadir múltiples veces al recargar la página
            header("Location: carrito.php?id=$id_producto");
            exit;
        }

    } catch (PDOException $e) {
        echo "Error en la conexión: " . $e->getMessage();
        exit;
    }

} else {
    echo "No se ha proporcionado un ID de producto.";
    exit;
}
?>
