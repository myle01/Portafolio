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
        <div style="display:flex; gap: 10px; align-items: center;">
            <h1 style="margin-bottom:0">Mis publicaciones</h1>
            <a class="new-post-btn" href="crear-publicacion.php">Nueva publicación</a>
        </div>
        
        <?php
        include('inc/conexion.php');
        $username = $_SESSION['username'];
        $query = "SELECT publicaciones.*, username as usuario FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario_id = usuarios.id WHERE username = '$username' ORDER BY fecha_creacion DESC";
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
                            echo substr(htmlspecialchars($row['contenido']), 0, 200) . '...';
                        }else{
                            echo htmlspecialchars($row['contenido']);
                        }
                    ?></p>
                    <small>Estado: <?php echo htmlspecialchars($row['estado']); ?></small>
                    <small>Fecha de publicacion <?php echo htmlspecialchars($row['fecha_creacion']); ?></small>
                    <div class="actions">
                        <a href="publicacion.php?id=<?php echo $row['id']; ?>">Ver publicación</a>
                        <a href="editar-publicacion.php?id=<?php echo $row['id']; ?>">Editar publicación</a>
                        <a href="#" class="delete-post" data-id="<?php echo $row['id']; ?>">Eliminar publicación</a>
                    </div>
                </div>
            <?php endwhile;
        } ?>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const deleteButtons = document.querySelectorAll('.delete-post');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e){
                    e.preventDefault();
                    const id = e.target.getAttribute('data-id');
                    if(confirm('¿Estás seguro de eliminar esta publicación?')){
                        window.location.href = 'eliminar-publicacion.php?id=' + id;
                    }
                });
            });
        });
    </script>
</main>
</body>
</html>
