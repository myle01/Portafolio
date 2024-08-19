<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Valor en Arreglo Asociativo</title>
</head>
<body>
    <h1>Buscar Valor en Arreglo Asociativo</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="llave">Ingrese la llave a buscar:</label>
        <input type="text" id="llave" name="llave" required>
        <input type="submit" value="Buscar">
    </form>
    <?php
        if (isset($_POST['llave'])) {
            $llave = $_POST['llave'];
            $datos = array(
                "nombre" => "Mariel Samaniego",
                "edad" => 19,
                "ciudad" => "Ciudad de Panamá",
                "nacimiento" => "1 de septiembre del 2004"
            );
            if (array_key_exists($llave, $datos)) {
                echo "El valor asociado a la llave '" . $llave . "' es: " . $datos[$llave];
            } else {
                echo "La llave '" . $llave . "' no existe en el arreglo asociativo.";
            }
        }
    ?>
</body>
</html>