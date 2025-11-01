<!--Crea una función promedio que reciba una lista de números y devuelva el promedio. Ver
funciones array_sum y count de arrays-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $numCadena = $_POST['num'];
        if(!empty($numCadena)){
            $array = explode(' ', $numCadena);
            $resultado = promedio($array);
        }else{
            $resultado = 0;
        }
        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 6 - Promedio</h2>
    <form action="" method="post">
        <label for="num1">
            Números:
            <input type="text" name="num" id="num"/>
        </label>
        <input type="submit" value="Calcular Promedio">
    </form>

    <p><?php if(isset($resultado)) echo $resultado ?></p>
</body>
</html>