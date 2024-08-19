<?php
session_start();
include 'inc/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Foro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include_once('template/header.php'); ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $search = $_GET['search'];
        $query = "SELECT *, username as usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario_id = usuarios.id WHERE titulo LIKE '%$search%' OR contenido LIKE '%$search%'";
        $result = mysqli_query($conn, $query);
    }
    ?>
    <main>
        <section>
            <h1>Resultados de la búsqueda</h1>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="post">
                        <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($row['contenido']); ?></p>
                        <small>Publicado por: <?php echo htmlspecialchars($row['usuario']); ?> el <?php echo htmlspecialchars($row['fecha_creacion']); ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No se encontraron resultados para la búsqueda "<?php echo htmlspecialchars($search); ?>"</p>
            <?php endif; ?>
        </section>
    </main>
</body>

