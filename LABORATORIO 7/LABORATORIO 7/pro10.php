<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invertir Vector</title>
</head>
<body>
    <h1>Invertir Vector</h1>
    <?php
        $vector = array(5, 2, 4, 1, 3);
        array_reverse($vector);
        echo "Vector invertido: ";
        for ($i = 0; $i < count($vector); $i++) {
            echo $vector[$i] . " ";
        }
    ?>
</body>
</html>