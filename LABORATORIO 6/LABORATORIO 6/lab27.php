<!DOCTYPE htmml>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $posicion = "arriba";
            
            switch($posicion) {
                case "arriba": //Bloque1
                    echo "La variable contiene";
                    echo " el valor arriba";
                    break;
                case "abajo": //Bloque 2
                    echo "La variable contiene";
                    echo " el valor abajo";
                    break;
                default: //Bloque 3
                    echo "La variable contiene otro valor";
                    echo " distinto de arriba y abajo";
            }
        ?>
    </body>
</html>