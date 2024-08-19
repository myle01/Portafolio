<?php
$conn = new mysqli('localhost', 'root', '', 'quiz_database');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>