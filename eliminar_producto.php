<?php
session_start(); // Iniciar la sesión


if (isset($_GET['index'])) {
    $index = $_GET['index'];

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        if (array_key_exists($index, $_SESSION['carrito'])) {
            unset($_SESSION['carrito'][$index]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
        header("Location: info_carro.php");
        exit();
    } else {
        echo "El carrito está vacío.";
    }

} else {
    echo "No se ha proporcionado un índice de producto.";
}
?>
