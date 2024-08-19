<?php
session_start();
include 'inc/funciones.php';
include('inc/conexion.php');

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}
$resultado = [
    'error' => false,
    'mensaje' => ''
];
if (isset($_POST['csrf'])) {
        // Procesar la imagen
        $imagen_url = '';
        if (!empty($_FILES['imagen']['name'])) {
            $target_dir = "uploads/imagenes/";
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
            $imagen_url = $target_file;
        }

        // Procesar el video
        $video_url = '';
        if (!empty($_FILES['video']['name'])) {
            $target_dir = "uploads/videos/";
            $target_file = $target_dir . basename($_FILES["video"]["name"]);
            move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
            $video_url = $target_file;
        }

        $publicacion = [
            "titulo"       => $_POST['titulo'],
            "contenido"    => $_POST['contenido'],
            "imagen_url"   => $imagen_url,
            "video_url"    => $video_url
        ];

        $consultaSQL = "INSERT INTO publicaciones (usuario_id, titulo, contenido, imagen_url, video_url, fecha_creacion, estado)";
        $consultaSQL .= "values ( '" . $_SESSION['id'] . "', '" . $publicacion['titulo'] . "', '" . $publicacion['contenido'] . "', '" . $publicacion['imagen_url'] . "', '" . $publicacion['video_url'] . "', NOW(), 'pendiente')";
        $result = mysqli_query($conn, $consultaSQL);
        if ($result) {
            header( 'Location: mis-publicaciones.php' );
        } else {
            $resultado['error'] = true;
            $resultado['mensaje'] = 'Error al actualizar la publicación';
        }
}
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
        <section>
            <h1>Crear publicacion</h1>
            <?php
            

            if ($resultado['error']) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?= $resultado['mensaje'] ?>
                </div>
            <?php
            }
            ?>
            <form class="form" action="crear-publicacion.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" value="">
                <label for="contenido">Contenido</label>
                <textarea name="contenido" id="contenido"></textarea>
                <label for="imagen">Subir Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                <label for="video">Subir Video</label>
                <input type="file" name="video" id="video" class="form-control" accept="video/*">
                <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <div class="actions">
                    <input type="submit" value="Crear publicacion">
                    <a href="mis-publicaciones.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>