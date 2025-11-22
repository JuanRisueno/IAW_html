<!--Ejercicio 13: Crea un programa que calcule el índice de masa corporal (IMC) dada la altura y el
peso de una persona. Usa un operador relacional para indicar si está en un rango saludable (18.5
a 24.9).-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $peso = $_GET["peso"];
        $altura = $_GET["altura"];

        $imc = $peso/(($altura/100)**2);

        echo "El peso indicado es: $peso.<br/>";
        echo "La altura indicado es: $altura.<br/>";
        echo "El IMC indicado es: $imc.<br/>";

        $salud = ($imc >= 18.5 && $imc <= 24.9)?"Estás saludable":"No estás saludable";

        echo $salud
    ?>
</body>
</html>