<?php
$conn = new mysqli('localhost', 'root', '', 'pasteleria');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>