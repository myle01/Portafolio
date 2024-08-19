
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "red_tracker";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para registrar acción de moderación
function registrarAccionModeracion($usuario_id, $accion, $detalles) {
    global $conn;
    
    $sql = "INSERT INTO moderacion (usuario_id, accion, fecha_accion, detalles) VALUES (?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $accion, $detalles);
    
    if ($stmt->execute()) {
        echo "Acción de moderación registrada correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}


$conn->close();
?>
