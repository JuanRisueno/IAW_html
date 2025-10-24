<!--Ejercicio 3: Define tres variables: una que almacene un número entero, otra que almacene un
número decimal, y otra que almacene una cadena de texto. Muestra los valores de cada variable
usando echo.-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $v1 = 9;
        $v2 = 9.1;
        $v3 = "9.9";

        echo "<p>La variable \$v1 es $v1 y es un número entero: ".gettype ($v1)."</p>";
        echo "<p>La variable \$v2 es $v2 y es un número con decimales: ".gettype ($v2)."</p>";
        echo "<p>La variable \$v3 es $v3 y es una cadena de carácteres: ".gettype ($v3)."</p>";
    ?>
</body>
</html>