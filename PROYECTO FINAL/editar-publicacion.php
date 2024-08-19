<?php
session_start();
include 'inc/funciones.php';
include('inc/conexion.php');

$resultado = [
    'error' => false,
    'mensaje' => ''
  ];
  
  if (!isset($_GET['id']) && !isset($_POST['id'])) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'La publicación no existe';
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
            <h1>Editar publicacion</h1>
            <?php
            if (isset($_POST['csrf'])) {
                csrf();
                    if (isset($_POST) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
                        die();
                    }
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
                        "id"           => $_POST['id'],
                        "titulo"       => $_POST['titulo'],
                        "contenido"    => $_POST['contenido'],
                        "imagen_url"   => $imagen_url,
                        "video_url"    => $video_url
                    ];

                    $consultaSQL = "UPDATE publicaciones SET titulo = '" . $publicacion['titulo'] . "', contenido = '" . $publicacion['contenido'] . "', estado = 'pendiente'";
                    if (!empty($publicacion['imagen_url'])) {
                        $consultaSQL .= ", imagen_url = '" . $publicacion['imagen_url'] . "'";
                    }
                    if (!empty($publicacion['video_url'])) {
                        $consultaSQL .= ", video_url = '" . $publicacion['video_url'] . "'";
                    }
                    $consultaSQL .= " WHERE id = " . $publicacion['id'];
                    $result = mysqli_query($conn, $consultaSQL);
                    if (!$result)  {
                        $resultado['error'] = true;
                        $resultado['mensaje'] = 'Error al actualizar la publicación';
                    }
            }
            if ($resultado['error']) {
            ?>
                <div class="alert alert-danger" role="alert">
                    <?= $resultado['mensaje'] ?>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_POST['id']) && !$resultado['error']) {
            ?>
                <div class="alert alert-success" role="alert">
                    La publicación ha sido actualizada correctamente
                </div>
            <?php
            }
            $username = $_SESSION['username'];
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            }
            $query = "SELECT publicaciones.*, username as usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario_id = usuarios.id WHERE username = '$username' AND publicaciones.id = $id";
            $result = mysqli_query($conn, $query);
            if (empty($result) || mysqli_num_rows($result) == 0) {
                echo "<p>No hay publicaciones disponibles.</p>";
            } else {
                $row = mysqli_fetch_assoc($result);
            ?>
                <form class="form" action="editar-publicacion.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $row['titulo']; ?>">
                    <label for="contenido">Contenido</label>
                    <textarea name="contenido" id="contenido"><?php echo $row['contenido']; ?></textarea>
                    <label for="imagen">Subir Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                    <label for="video">Subir Video</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/*">
                    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <div class="actions">
                        <input type="submit" value="Editar publicacion">
                        <a href="mis-publicaciones.php">Cancelar</a>
                    </div>
                </form>
            <?php
            } ?>
        </section>
    </main>
</body>

</html>