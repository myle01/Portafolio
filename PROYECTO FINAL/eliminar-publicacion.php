<?php
include 'inc/funciones.php';
include 'inc/conexion.php';

$resultado = [
    'error' => false,
    'mensaje' => ''
];

$id = $_GET['id'];
$consultaSQL = "DELETE FROM publicaciones WHERE id = $id";

$result = mysqli_query($conn, $consultaSQL);
if ($result) {
    header('Location: mis-publicaciones.php');
} else {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'Error al eliminar la publicación';
}
