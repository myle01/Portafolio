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

// Consulta para obtener los datos del usuario
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" type="text/css" href="css/styles_vistas.css">
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <p>Nombre de Usuario: <?php echo htmlspecialchars($user['username']); ?></p>
    <?php if (!empty($user['profile_picture'])): ?>
        <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Foto de Perfil" />
    <?php endif; ?>
    <a href="gestion.php">Actualizar Perfil</a>
    <button onclick="window.location.href='index.php'">Volver al Inicio</button>
</body>
</html>
