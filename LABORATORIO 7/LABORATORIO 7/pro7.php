<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Elementos de una Matriz</title>
</head>
<body>
    <h1>Imprimir Elementos de una Matriz</h1>
    <?php
        $matriz = array(
            array(1, 2, 3),
            array(4, 5, 6),
            array(7, 8, 9)
        );
        for ($i = 0; $i < count($matriz); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($matriz[$i]); $j++) {
                echo "<td>" . $matriz[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
    ?>
</body>
</html>