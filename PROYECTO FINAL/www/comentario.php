<!DOCTYPE html>
<html lang ="es">
    <head>
        <meta charset="UTF-8">
        <title>Agregar Comentario</title>
        <link rel="stylesheet" href="styles.css">
</head>
<form action="comentario.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <textarea name="comment" required></textarea>
    <button type="submit" name="submit_comment">Agregar Comentario</button>
</form>
<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contenido= $_POST['comment'];
    $sql = "INSERT INTO comentarios (contenido) VALUES ('$contenido')";
    if($conn->query($sql) === TRUE){
        echo "Se agregó el comentario";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
</html>