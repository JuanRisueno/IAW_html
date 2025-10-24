<!--Ejercicio 7: Dado un número de segundos almacenado en una variable, calcula cuántas horas, minutos y segundos representa. Muestra el resultado en formato "HH:MM:SS".-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $segundos=$_GET["segundos"];
        echo "<p>Hay $segundos segundos.</p>";
        $horas=intval($segundos/3600);
        $descHoras=$horas*3600;
        $segundos=$segundos-$descHoras;
        $minutos=intval($segundos/60);
        $descMinutos=$segundos-$minutos;
        $segundos=$segundos-$descMinutos;

        echo "Eso equivale a $horas horas, $minutos minutos y $segundos segundos";
    ?>
</body>
</html>