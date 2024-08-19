<?php
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
    <section>
        <h1>Publicaciones Recientes</h1>
        <?php
        include('inc/conexion.php');
        $query = "SELECT *, username as usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario_id = usuarios.id ORDER BY fecha_creacion DESC LIMIT 10";
        $result = mysqli_query($conn, $query);
        if(empty($result) || mysqli_num_rows($result) == 0) {
            echo "<p>No hay publicaciones disponibles.</p>";
        }else{
            while ($row = mysqli_fetch_assoc($result)): 
            ?>
                <div class="post">
                <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                    <p><?php 
                        // echo content max 200 characters and add ... if content is longer than 200 characters. Add Leer más link.
                        if(strlen($row['contenido']) > 200){
                            echo substr(htmlspecialchars($row['contenido']), 0, 200) . '... <a href="publicacion.php?id=' . $row['id'] . '">Leer más</a>';
                        }else{
                            echo htmlspecialchars($row['contenido']). '... <a href="publicacion.php?id=' . $row['id'] . '">Leer más</a>';
                        }
                    ?></p>
                    <small>Publicado por: <?php echo htmlspecialchars($row['usuario']); ?> el <?php echo htmlspecialchars($row['fecha_creacion']); ?></small>
                </div>
            <?php endwhile;
        } ?>
    </section>
</main>
</body>
</html>
