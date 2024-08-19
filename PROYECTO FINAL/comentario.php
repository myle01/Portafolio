<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contenido = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $usuario_id = $_SESSION['id'];
    $sql = "INSERT INTO comentarios (contenido, publicacion_id, usuario_id, estado) VALUES ('$contenido', '$post_id', '$usuario_id', 'pendiente')";
    if ($conn->query($sql) === TRUE) {
        echo "Se agregó el comentario. Esta pendiente por moderación.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<div class="comments">
    <?php
    $query = "SELECT *, usuarios.id as user_id FROM comentarios INNER JOIN usuarios ON comentarios.usuario_id = usuarios.id WHERE publicacion_id = " . $_GET['id'] . " AND estado='aprobado' ORDER BY fecha_comentario DESC";
    $result = mysqli_query($conn, $query);
    if (empty($result) || mysqli_num_rows($result) == 0) {
        echo "<p>No hay comentarios disponibles.</p>";
    } else {
        while ($row = mysqli_fetch_assoc($result)):
    ?>
            <div class="comment">
                <p><?php echo htmlspecialchars($row['contenido']); ?></p>
                <small>Publicado por: <?php echo htmlspecialchars($row['username']); ?> el <?php echo htmlspecialchars($row['fecha_comentario']); ?></small>
                <?php
                if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
                ?>
                    <div class="comment-actions">
                        <a href="eliminar-comentario.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                    </div>
                <?php
                }
                ?>
            </div>
    <?php endwhile;
    } ?>

</div>
<?php if (isset($_SESSION['username'])): ?>
    <form class="comment-form" action="publicacion.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $_GET['id']; ?>">
        <label for="comment">Comentario:</label>
        <textarea name="comment" required></textarea>
        <button type="submit" name="submit_comment">Agregar Comentario</button>
    </form>
<?php endif;  ?>