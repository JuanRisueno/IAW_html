<!--Ejercicio 14: Dado un número entero, usa un operador ternario para mostrar si es par o impar.-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $n=$_GET["n"];
        echo "El número indicado es $n.<br/>";

        $modulo = $n % 2;

        $par = $modulo == 0?"El número $n es par.":"El número $n es impar.";
        echo $par
    ?>
</body>
</html>