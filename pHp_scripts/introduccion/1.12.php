<!--Ejercicio 12: Crea una variable que almacene la cantidad de productos comprados por un
cliente y en otra el precio de cada unidad. Usa un operador ternario para aplicar un descuento
del 20% si ha comprado más de 10 productos. Muestra la cantidad a pagar-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $cantidad=$_GET["cantidad"];
        $precio=$_GET["precio"];
        echo "Has comprado un total de $cantidad unidades a un precio de $precio.<br/>";

        $total = $cantidad >= 10?"Al comprar 10 o más unidades tiene un descuento del 20% y tu precio es: ".($precio=($precio*.8)*$cantidad):"Has comprado menos de 10 unidades y tu precio es: ".($precio=$precio*$cantidad);

        echo $total;
    ?>
</body>
</html>