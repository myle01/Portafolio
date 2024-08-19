<?php
include 'inc/config.php';
// Elimina la DB si existe y creala nuevamente y ejecuta el archivo /db/dump.sql.
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
$db_selected = mysqli_select_db($conn, $dbname);

if ($db_selected) {
    $sql = "DROP DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Base de datos $dbname eliminada exitosamente.<br>";
    } else {
        die("Error al eliminar la base de datos: " . $conn->error);
    }
}

$sql = "CREATE DATABASE $dbname CHARACTER SET utf8 COLLATE utf8_general_ci";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos $dbname creada exitosamente.<br>";
    mysqli_select_db($conn, $dbname);
    // Importar el archivo SQL
    $dumpFile =  __DIR__ . '/db/dump.sql';
    //file convert to string to execute query in db.
    $sql = file_get_contents($dumpFile);
    if ($conn->multi_query($sql) === TRUE) {
        echo "Archivo SQL importado exitosamente.";
    } else {
        echo "Error al importar el archivo SQL.";
    }
    
} else {
    die("Error al crear la base de datos: " . $conn->error);
}





