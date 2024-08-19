<!DOCTYPE html>
<html leng="es">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <link rel="stylesheet" type="text/css" href="css/styles_vistas.css">
</head>
<body>
    <form action="registro.php" method="POST">
        <h1>Registro de Usuario</h1>
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Registrar</button>
        <button onclick="window.location.href='index.php'">Volver al Inicio</button>
    </form>
</body>
</html>
<?php
include 'inc/conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verifica si el nombre de usuario ya existe
    $sql_check = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "El nombre de usuario '$username' ya existe, intente nuevamente.";
    } else {
        // Insertar el nuevo usuario, el rol se asignará desde la base de datos (asumiendo una configuración por defecto)
        $sql = "INSERT INTO usuarios (username, password, rol_id) VALUES ('$username', '$password', 2)";
        
        if($conn->query($sql) === TRUE){
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>