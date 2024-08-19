<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Lista de Tareas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="table">
    <h1>Lista de Registros</h1>
    <?php
    include 'conexion.php';
    $sql = "SELECT * FROM quiz_form_data";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Nombre</th><th>Apellido</th></th><th>Username</th></th></th><th>Email</th></th><th>Password</th></th>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><th>".$row["password"]."</td>";
        }
        echo "</table>";
    } else {
        echo "0 resultados";
    }
    $conn->close();
    ?>
    </div><br><br>
    <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>