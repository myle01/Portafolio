<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Números Pares del 1 al 100</title>
</head>
<body>
    <h1>Suma de Números Pares del 1 al 100</h1>
    <?php
        $suma = 0;
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 2 == 0) {
                $suma += $i;
            }
        }
        echo "La suma de los números pares del 1 al 100 es: " . $suma;
    ?>
</body>
</html>