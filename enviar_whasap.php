<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    if (!empty($_SESSION['carrito'])) {
        $host = 'localhost';
        $dbname = 'dulceria';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO compra (carrito_id, nombre_completo, telefono, ciudad, barrio, direccion, email) VALUES (:carrito_id, :nombre_completo, :telefono, :ciudad, :barrio, :direccion, :email)";
            $stmt = $pdo->prepare($query);
            $carrito_id = session_id(); 
            $stmt->bindParam(':carrito_id', $carrito_id);
            $stmt->bindParam(':nombre_completo', $nombre_completo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':ciudad', $ciudad);
            $stmt->bindParam(':barrio', $barrio);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Crear mensaje para WhatsApp
            $mensaje = "Buen dia ¡Nuevo pedido!\n";
            $mensaje .= "Nombre Completo: $nombre_completo\n";
            $mensaje .= "Teléfono: $telefono\n";
            $mensaje .= "Ciudad: $ciudad\n";
            $mensaje .= "Barrio: $barrio\n";
            $mensaje .= "Dirección: $direccion\n";
            $mensaje .= "Email: $email\n\n";
            $mensaje .= "Productos:\n";

            foreach ($_SESSION['carrito'] as $producto) {
                $mensaje .= $producto['nombre'] . " - $" . $producto['precio'] . "\n";
            }

            $mensaje .= "\nTotal: $" . number_format(array_sum(array_column($_SESSION['carrito'], 'precio')), 2);

            $whatsapp_number = '3015155392'; 
            $url = 'https://wa.me/' . $whatsapp_number . '?text=' . urlencode($mensaje);

            unset($_SESSION['carrito']);

            header("Location: $url");
            exit();

        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    } else {
        echo "El carrito está vacío.";
    }

} else {
    echo "No se ha enviado el formulario.";
}
?>
