<!--Ejercicio 6: Calcula el perímetro y área de un rectángulo, dadas su base y su altura, almacenadas
en dos variables.-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $base=$_GET["base"];
        $altura=$_GET["altura"];

        echo "<p>Base = $base</p>"; #Párrafos
        echo "<pre>Altura = $altura</pre>"; #Texto preformateado

        $rectangulo=$base*$altura;
        $triangulo=($base*$altura)/2;

        echo "Área del rectángulo = $rectangulo"."<br/>"; #Salto de línea
        echo "Área del triángulo = $triangulo";

    ?>
</body>
</html>