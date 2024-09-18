<?php
session_start(); // Iniciar la sesión

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Conexión a la base de datos
    $host = 'localhost';
    $dbname = 'dulceria';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para traer los detalles del producto con el id correspondiente
        $query = "SELECT nombre, descripcion, precio, imagen_url FROM producto WHERE producto_id = :producto_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':producto_id', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

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
    <link rel="icon" href="img/logo.png">

</head>
<body>

    <header>
        <nav>
            <img class="logo" src="img/logo.png" alt="Logo">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacto.html">Contactanos</a></li>
            </ul>
            <div class="cart" onclick="window.location.href='info_carro.php'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
            </div>
        </nav>
    </header>

    <div class="titulo">
        <h1 class="h11">NUESTROS </h1>
        <h1 class="h22">PRODUCTOS</h1>
    </div>

    <main class="productos">
        <div class="producto-detalle">

            <img src="<?php echo htmlspecialchars($producto['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>">
        
            <div class="descripcion_pro">

                <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>

                <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            </div>
            <div class="producto-precio-carrito">
                <p class="precio">$<?php echo htmlspecialchars($producto['precio']); ?></p>
                <a href="agregar_carrito.php?id=<?php echo $id_producto; ?>" class="btn-agregar-carrito">Añadir al carrito</a>
            </div>
        </div>
    
    </main>
    
    <section>
        <a href="productos.php">Volver a la tienda</a>
    </section>
</body>
</html>
