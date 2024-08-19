<!DOCTYPE htmml>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $a = 8;
            $b = 3;
            $c = 3;
            echo ($a == $b) && ($c > $b), "<br>";
            echo ($a == $b) || ($b == $c), "<br>";
            echo !($b <= $c), "<br>";
        ?>
    </body>
</html>