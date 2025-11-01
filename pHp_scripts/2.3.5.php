<!--Crea una función esPrimo que reciba un número y determine si es primo.-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $num = $_POST['num'];
        $resultado = esPrimo($num);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 5 - ¿Es primo?</h2>
    <form action="" method="post">
        <label for="num1">
            Número:
            <input type="text" name="num" id="num"/>
        </label>
        <input type="submit" value="¿Es primo?">
    </form>

    <p><?php if(isset($resultado)) echo $resultado ?></p>
</body>
</html>