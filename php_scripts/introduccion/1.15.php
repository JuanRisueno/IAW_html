<!--Ejercicio 15: Crea un programa que reciba la temperatura en grados Celsius y muestre si el agua
está congelada, en estado líquido o hirviendo (usando operadores relacionales y ternarios)-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $grados = $_GET["grados"];
        echo "<p>El agua está liquida entre 0 grados y 100 grados. A menos de 0 grados se congela y a más de 100 grados hierve</p>";
        echo "El agua está a $grados grados.<br/>";
        
        $estado = $grados >=100?"El agua está hirviendo":($grados > 0?"El agua está liquida":"El agua está congelada");

        echo $estado
    ?>
</body>
</html>