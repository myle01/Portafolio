<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Elementos de un Vector</title>
</head>
<body>
    <h1>Suma de Elementos de un Vector</h1>
    <?php
        $vector = array(1, 2, 3, 4, 5);
        $suma = 0;
        for ($i = 0; $i < count($vector); $i++) {
            $suma += $vector[$i];
        }
        echo "La suma de los elementos del vector es: " . $suma;
    ?>
</body>
</html>