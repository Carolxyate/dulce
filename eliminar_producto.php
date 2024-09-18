<?php
session_start(); // Iniciar la sesión

// Verificar si el parámetro 'index' está presente
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Verificar si el carrito tiene productos
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Eliminar el producto del carrito
        if (array_key_exists($index, $_SESSION['carrito'])) {
            unset($_SESSION['carrito'][$index]);
            // Reindexar el array para evitar huecos
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }

        // Redirigir a la página del carrito
        header("Location: info_carro.php");
        exit();
    } else {
        echo "El carrito está vacío.";
    }

} else {
    echo "No se ha proporcionado un índice de producto.";
}
?>
