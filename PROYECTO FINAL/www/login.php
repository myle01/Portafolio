<!DOCTYPE html>
<html leng="es">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/styles_vistas.css">
    </head>
    <body>
        <form action="login.php" method="POST">
            <h1>Inicio de Sesión</h1>
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Iniciar Sesión</button>
            <button onclick="window.location.href='index.php'">Volver al Inicio</button>
        </form>
</body>
</html>

<?php
session_start();
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE username = '$username' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
    $conn->close();
}