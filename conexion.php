<?php
$host = 'localhost';    // El nombre del host del servidor MySQL (puede ser '127.0.0.1' o 'localhost')
$dbname = 'dulceria';  // Nombre de la base de datos
$username = 'root';      // Nombre de usuario de MySQL
$password = '';          // Contraseña de MySQL

try {
    // Crear una nueva instancia de PDO 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mostrar un mensaje de éxito si la conexión fue exitosa
    echo "Conexión exitosa a la base de datos!";
    
} catch (PDOException $e) {
    // En caso de error, se captura la excepción y se muestra el mensaje de error
    echo "Error en la conexión: " . $e->getMessage();
}
?>
