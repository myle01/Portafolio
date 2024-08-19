<?php
session_start();
?>
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
include 'inc/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario existe, ahora verifica el rol y la contraseña
        $sql = "SELECT usuarios.id, usuarios.username, usuarios.password, roles.rol AS rol 
                FROM usuarios 
                JOIN roles ON usuarios.rol_id = roles.id 
                WHERE usuarios.username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verifica la contraseña
            if (password_verify($password, $row['password'])) {
                // Guarda el username y el rol en la sesión
                $_SESSION['username'] = $username;
                $_SESSION['rol'] = $row['rol']; // Guarda el nombre del rol
                $_SESSION['id'] = $row['id']; // Guarda el id del usuario

                // Redirige al usuario al archivo index.php
                header('Location: index.php');
                exit();
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Acceso denegado.";
        }
    } else {
        echo "Usuario no registrado";
    }

    $stmt->close();
    $conn->close();
}
?>