<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información   
 de Base de Datos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

include 'conexion.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<h1>Información de la Base de Datos</h1>";
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    while ($fieldinfo = $result->fetch_field()) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron registros.";
}

$conn->close();
?>