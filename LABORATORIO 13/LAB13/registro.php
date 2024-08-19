<!DOCTYPE html>
<html lang ="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Usuario</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="registro.php" method="POST";=>
    <label for=nombre_usuario>Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
    <label for="correo">Correo Electronico:</label>
    <input type="text" id="correo" name="correo" required><br><br>
    <label for=password>Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Registrar</button>
    <button onclick="window.location.href='login.php'">Iniciar Sesion</button>
</form>
</body>
</html>
<?php
include 'conexion.php';
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $nombre_usuario=$_POST['nombre_usuario'];
    $correo=$_POST['correo'];
    $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios(nombre_usuario, correo, password) VALUES('$nombre_usuario','$correo','$password')";
    if($conn->query($sql) === TRUE){
        echo "Registro exitoso";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>