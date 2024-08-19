<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Tabla de Multiplicar</h1>
    <table>
        <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<th>" . $i . "</th>";
                for ($j = 1; $j <= 10; $j++) {
                    $resultado = $i * $j;
                    echo "<td>" . $resultado . "</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>