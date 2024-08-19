<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirige si no está autenticado
    exit();
}

// Incluye el archivo de conexión a la base de datos
include 'inc/conexion.php'; // Asegúrate de que la ruta sea correcta

// Recupera el nombre de usuario actual
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $profile_picture = $_FILES['profile_picture'];

    // Actualiza el nombre de usuario si se ha cambiado
    if (!empty($new_username) && $new_username !== $username) {
        $stmt = $conn->prepare('UPDATE usuarios SET username = ? WHERE username = ?');
        $stmt->bind_param('ss', $new_username, $username);
        $stmt->execute();
        $_SESSION['username'] = $new_username; // Actualiza la sesión con el nuevo nombre de usuario
    }

    // Actualiza la contraseña si se ha proporcionado
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare('UPDATE usuarios SET password = ? WHERE username = ?');
        $stmt->bind_param('ss', $hashed_password, $username);
        $stmt->execute();
    }

    // Manejo de la foto de perfil
    if ($profile_picture['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($profile_picture['name']);
        
        if (move_uploaded_file($profile_picture['tmp_name'], $upload_file)) {
            $stmt = $conn->prepare('UPDATE usuarios SET profile_picture = ? WHERE username = ?');
            $stmt->bind_param('ss', $upload_file, $new_username);
            $stmt->execute();
        } else {
            echo "Error al subir la foto de perfil.";
        }
    }

    header('Location: perfil.php'); // Redirige a la página de perfil o a donde desees
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Perfil</title>
    <link rel="stylesheet" type="text/css" href="css/styles_vistas.css">
</head>
<body>
    <form action="gestion.php" method="POST" enctype="multipart/form-data">
        <h1>Gestionar Perfil</h1>
        <label for="new_username">Nuevo Nombre de Usuario:</label>
        <input type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($username); ?>" required><br>
        <label for="new_password">Nueva Contraseña (dejar en blanco si no desea cambiarla):</label>
        <input type="password" id="new_password" name="new_password"><br>
        <label for="profile_picture">Foto de Perfil (dejar en blanco si no desea cambiarla):</label>
        <input type="file" id="profile_picture" name="profile_picture"><br>
        <button type="submit">Actualizar Perfil</button>
        <button onclick="window.location.href='index.php'">Volver al Inicio</button>
    </form>
</body>
</html>

