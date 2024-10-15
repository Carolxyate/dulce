<?php
session_start();

include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin/index.php');
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilo_blog.css">
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
                <li><a href="login_admin.php">admin</a></li>

            </ul>
            <div class="cart" onclick="window.location.href='info_carro.php'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                  </svg>
            </div>
        </nav>
    </header>
    <div class="titulo">
        <h1 class="h11">Inicio de sesión </h1>
        <h1 class="h22">Administrador</h1>
    </div>
    <form action="login_admin.php" method="post">
        <label for="email">Usuario:</label>
        <input type="text" name="email" placeholder=" Email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Contraseña" required>
        <br>
        <input type="submit" value="Iniciar sesión">
    </form>
    
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
