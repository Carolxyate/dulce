<?php
session_start(); // Iniciar la sesión

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/estilo_carro.css">
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
        <h1 class="h11">CARRITO</h1>
        <h1 class="h22">DE COMPRAS</h1>
    </div>

    <main class="productos">
        <?php
        // Verificar si el carrito tiene productos
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            echo '<ul>';
            foreach ($_SESSION['carrito'] as $index => $producto) {
                $total += $producto['precio']; // Sumar el precio al total
                $imagen_url = isset($producto['imagen_url']) ? $producto['imagen_url'] : 'https://via.placeholder.com/150'; // Imagen por si no está disponible
                echo '<li>';
                echo '<img src="' . htmlspecialchars($imagen_url) . '" alt="Imagen de ' . htmlspecialchars($producto['nombre']) . '" style="width: 150px; height: 150px;"> ';
                echo '<div>';
                echo '<h2>' . htmlspecialchars($producto['nombre']) . '</h2>';
                echo '<p>' . htmlspecialchars($producto['descripcion']) . '</p>';
                echo '<p>Precio: $' . htmlspecialchars($producto['precio']) . '</p>';
                echo '<a href="eliminar_producto.php?index=' . $index . '" class="btn-eliminar">Eliminar</a>'; // Botón para eliminar producto
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            echo '<p><strong>Total: $' . number_format($total, 2) . '</strong></p>'; // Mostrar el total
            echo '<a href="proceso_compra.php" class="btn-procesar">Procesar Compra</a>'; // Botón para procesar la compra
        } else {
            echo "<p>El carrito está vacío.</p>";
        }
        ?>
    </main>
    <section>
        <a href="productos.php">Volver a la tienda</a>
    </section>
</body>
</html>
