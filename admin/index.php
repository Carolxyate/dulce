<?php
include 'conexion.php'; 

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login_admin.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="icon" href="img/logo.png">

</head>
<body>
    
    <header>
        <nav>
            <img class="logo" src="img/logo.png" alt="Logo">
            <h1>Bienvenido al Panel de Administración</h1>
            <a href="logout_admin.php">Cerrar sesión</a>

        </nav>
    </header>
    <main class="maincontainer">
        <h1 class="admin-title">Panel de Administración</h1>
        
        <!-- Sección de Productos -->
        <section class="admin-section">
            <h2>Gestión de Productos</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM producto";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['producto_id']}</td>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['descripcion']}</td>
                                    <td>{$row['precio']}</td>
                                    <td><img src='{$row['imagen_url']}' alt='Imagen Producto' width='50'></td>
                                    <td>
                                        <a href='editar_producto.php?id={$row['producto_id']}'>Editar</a>
                                        <a href='eliminar_producto.php?id={$row['producto_id']}'>Eliminar</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay productos</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <div class="contButton">
                <button class="btnsave" onclick="window.location.href='agregar_producto.php'">Agregar Producto</button>
            </div>
        </section>
        
        <section class="admin-section">
            <h2>Gestión de Ordenes</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Carrito</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Ciudad</th>
                        <th>Barrio</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM compra";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['carrito_id']}</td>
                                    <td>{$row['nombre_completo']}</td>
                                    <td>{$row['telefono']}</td>
                                    <td>{$row['ciudad']}</td>
                                    <td>{$row['barrio']}</td>
                                    <td>{$row['direccion']}</td>
                                    <td>{$row['email']}</td>
                                    <td>
                                        <a href='editar_campo.php?id={$row['carrito_id']}'>Editar</a>
                                        <a href='eliminar_campo.php?id={$row['carrito_id']}'>Eliminar</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No hay campos</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        
    </main>
    
</body>
</html>
