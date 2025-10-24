<!--Ejercicio 2: Crea una variable que almacene el valor de una base y otra que almacene la altura
de un triángulo. Calcula el área del triángulo (fórmula: ½ * base * altura) y muestra el resultado.-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //$base = 5;
        //$altura = 8;

        $base = $_GET['base'];
        $altura = $_GET['altura'];
        echo "<p>La base es $base</p>";
        echo "La altura es $altura"."<br/>";

        $area = $base * $altura;

        echo "El área del rectángulo es: $area";
    ?>
</body>
</html>