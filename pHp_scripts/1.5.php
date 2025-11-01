<!--Ejercicio 5: Crea dos variables que almacenen dos números enteros. Realiza las operaciones
básicas (suma, resta, multiplicación y división) y muestra los resultados.-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $v1 = $_GET['v1'];
        $v2 = $_GET['v2'];

        echo "La variable 1 es $v1"."<br/>";
        echo "La variable 2 es $v2"."<br/>";
        echo "Suma: $v1 + $v2 = ".($v1+$v2)."<br/>";
        echo "Resta: $v1 - $v2 = ".($v1-$v2)."<br/>";
        echo "Divisón: $v1 / $v2 = ".($v1/$v2)."<br/>";
        echo "Multiplicación: $v1 * $v2 = ".($v1*$v2)."<br/>";
    ?>    
</body>
</html>