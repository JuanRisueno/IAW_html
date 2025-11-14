<!--Ejercicio 10: Crea una variable que almacene la edad de una persona y usa un operador ternario
para determinar si es mayor de edad o no-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $edad=$_GET["edad"];
        echo "La edad es $edad.<br/>";

        $mayor = $edad >= 18?"Eres mayor de edad":"Eres menor de edad";
        echo $mayor
    ?>
</body>
</html>