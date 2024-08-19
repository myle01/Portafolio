<?php
// Incluye la conexión a la base de datos
$conn = include "inc/conexion.php";

// Función para obtener las publicaciones que requieren moderación
function getPublicacionesParaModerar()
{
    global $conn;
    $sql = "SELECT * FROM publicaciones WHERE estado = 'pendiente'";
    $resultado = mysqli_query($conn, $sql);
    return $resultado;
}

// Función para obtener los comentarios que requieren moderación
function getComentariosParaModerar()
{
    global $conn;
    $sql = "SELECT * FROM comentarios WHERE estado = 'pendiente'";
    $resultado = mysqli_query($conn, $sql);
    return $resultado;
}

// Función para realizar la moderación de una publicación
function moderarPublicacion($idPublicacion, $estado)
{
    global $conn;
    $sql = "UPDATE publicaciones SET estado = '$estado' WHERE id = '$idPublicacion'";
    mysqli_query($conn, $sql);
}

// Función para realizar la moderación de un comentario
function moderarComentario($idComentario, $estado)
{
    global $conn;
    $sql = "UPDATE comentarios SET estado = '$estado' WHERE id = '$idComentario'";
    mysqli_query($conn, $sql);
}

// Procesa la solicitud de moderación de una publicación
if (isset($_POST['moderar'])) {
    $idPublicacion = $_POST['idPublicacion'];
    $estado = $_POST['estado'];
    moderarPublicacion($idPublicacion, $estado);
    header('Location: moderacion.php');
    exit;
}

// Procesa la solicitud de moderación de un comentario
if (isset($_POST['moderarComentario'])) {
    $idComentario = $_POST['idComentario'];
    $estado = $_POST['estado'];
    moderarComentario($idComentario, $estado);
    header('Location: moderacion.php');
    exit;
}

// Muestra la lista de publicaciones y comentarios que requieren moderación
$publicaciones = getPublicacionesParaModerar();
$comentarios = getComentariosParaModerar();

session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Foro</title>
    <link rel="stylesheet" href="css/styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <?php include_once('template/header.php'); ?>
    <main>
        <!-- Muestra la lista de publicaciones y comentarios que requieren moderación -->
        <h1>Moderación</h1>
        <h2>Publicaciones</h2>
        <ul>
            <?php while ($publicacion = mysqli_fetch_assoc($publicaciones)) { ?>
                <li>
                    <h3><?php echo $publicacion['titulo']; ?></h3>
                    <p><?php echo $publicacion['contenido']; ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="idPublicacion" value="<?php echo $publicacion['id']; ?>">
                        <select name="estado">
                            <option value="aprobado">Aprobado</option>
                            <option value="rechazado">Rechazado</option>
                        </select>
                        <input type="submit" name="moderar" value="Moderar">
                    </form>
                </li>
            <?php } ?>
        </ul>

        <h2>Comentarios</h2>
        <ul>
            <?php while ($comentario = mysqli_fetch_assoc($comentarios)) { ?>
                <li>
                    <h3><?php echo $comentario['contenido']; ?></h3>
                    <p><?php echo $comentario['fecha_comentario']; ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="idComentario" value="<?php echo $comentario['id']; ?>">
                        <select name="estado">
                            <option value="aprobado">Aprobado</option>
                            <option value="rechazado">Rechazado</option>
                        </select>
                        <input type="submit" name="moderarComentario" value="Moderar">
                    </form>
                </li>
            <?php } ?>
        </ul>
    </main>
</body>

</html>