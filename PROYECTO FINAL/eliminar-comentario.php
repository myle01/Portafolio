<?php
include 'inc/funciones.php';
include 'inc/conexion.php';

$resultado = [
    'error' => false,
    'mensaje' => ''
];

$id = $_GET['id'];
$consultaSQL = "DELETE FROM comentarios WHERE id = $id";

$result = mysqli_query($conn, $consultaSQL);
if ($result) {
    header('Location: publicacion.php?id=' . $_GET['id']);
} else {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'Error al eliminar la comentario';
}
