<?php
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
        // Cambiamos 'producto_id' a 'id_producto'
        $query = "SELECT nombre, descripcion, precio, imagen_url FROM producto WHERE producto_id = :producto_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':producto_id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch del producto como un array asociativo
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            echo "Producto no encontrado.";
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <nav>
            <img class="logo" src="https://via.placeholder.com/100" alt="Logo">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacto.html">Contáctanos</a></li>
            </ul>
            <div class="cart">
                <img src="https://img.icons8.com/ios-filled/50/shopping-cart.png" alt="Carrito de compras">
            </div>
        </nav>

    </header>

    <h1>NUESTROS PRODUCTOS</h1>

    <div class="producto-detalle">
        <!-- Mostrar imagen del producto -->
        <img src="<?php echo htmlspecialchars($producto['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>">

        <!-- Mostrar nombre del producto -->
        <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>

        <!-- Mostrar descripción del producto -->
        <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>

        <!-- Mostrar precio del producto -->
        <p><strong>Precio:</strong> $<?php echo htmlspecialchars($producto['precio']); ?></p>
        <a href="añadir_carro.php?id=<?php echo $id_producto; ?>">Añadir al carrito</a>
    </div>
    <section>
            <a href="productos.php">Volver a la tienda</a>
</section>
</body>
</html>
