<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Elementos de un Vector</title>
</head>
<body>
    <h1>Imprimir Elementos de un Vector</h1>
    <?php
        $vector = array(1, 2, 3, 4, 5);
        echo "Elementos del vector: ";
        for ($i = 0; $i < count($vector); $i++) {
            echo $vector[$i] . " ";
        }
    ?>
</body>
</html>