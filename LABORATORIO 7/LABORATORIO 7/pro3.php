<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Factorial</title>
</head>
<body>
    <h1>Calcular Factorial</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" value="Calcular">
    </form>
    <?php
        if (isset($_POST['numero'])) {
            $numero = $_POST['numero'];
            $factorial = 1;
            for ($i = 1; $i <= $numero; $i++) {
                $factorial *= $i;
            }
            echo "El factorial de " . $numero . " es: " . $factorial;
        }
    ?>
</body>
</html>