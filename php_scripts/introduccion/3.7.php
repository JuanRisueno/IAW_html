<!--Crea una función convertirBinario que reciba un número y lo convierta a binario. En PHP hay
una función decbin que lo hace automático. La idea es que no la uséis para practicar. En su
lugar si os voy a decir que podéis usar intdiv para hacer la división entera (sin decimales) o
también podéis usar intval o floor que eliminan los decimales de un número conservando solo
la parte entera. Alguna de las opciones anteriores junto con el operador %.-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $n1 = $_POST['num'];
        $r = convertirBinario($n1);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir Binario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 7 - Convertir en binario</h2>
    <form action="" method="post">
        <label for="num">
            Número:
            <input type="text" name="num" id="num"/>
        </label>
        <input type="submit" value="Convertir">
    </form>

    <p><?php if(isset($r)) echo "Resultado = $r" ?></p>
</body>
</html>