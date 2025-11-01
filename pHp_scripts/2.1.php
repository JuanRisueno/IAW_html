<!--Ejercicio 1. ¿Positivo, Negativo o Cero?
Escribir un script que reciba un número y determine si es positivo, negativo o cero.-->

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $num = $_POST['numero'];
        if ($num > 0){
            $resultado = 'Positivo';
        }elseif($num < 0){
            $resultado = 'Negativo';
        }else{
            $resultado = 'Es Cero';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2.1</title>
</head>
<body>
    <h1>¿NEGATIVO, POSITIVO O CERO?</h1>
    <form action="" method="post">
        <label for="numero">
            Introduce un número:
            <input type="text" name="numero" id=""> <?php if(isset($resultado))echo $resultado?>
        </label>
        <br/>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>