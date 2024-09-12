<?php
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

    // Consulta para traer todos los productos de la base de datos
    $query = "SELECT producto_id, nombre, imagen_url FROM producto";
    $stmt = $pdo->query($query);

    // Fetch de todos los productos como un array asociativo
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Dulces</title>
    <link rel="stylesheet" href="css/estilo.css">
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

    <h1>Lista de Productos</h1>

    <div class="productos">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <!-- Enlace que redirige a la página del producto con el ID -->
                    <a href="info_producto.php?id=<?php echo $producto['producto_id']; ?>">
                        <!-- Mostrar imagen del producto -->
                        <img src="<?php echo htmlspecialchars($producto['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>">
                    </a>

                    <!-- Mostrar nombre del producto -->
                    <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles.</p>
        <?php endif; ?>
    </div>

</body>
</html>
