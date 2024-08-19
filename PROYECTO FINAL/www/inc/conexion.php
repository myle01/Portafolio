<?php
$conn = new mysqli('localhost', 'root', '', 'red_tracker');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>