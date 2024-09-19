<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "dulceria"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "";
?>
