<!--Crea una función suma que reciba dos números y devuelva su suma. Utiliza la función en un
script que reciba dos números y muestre el resultado.-->

<?php
    require_once 'funciones.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        //var_dump($_POST); //Cuando mandamos algo, nos informa que se está mandando
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        
        $resultado = sumar($num1, $num2);
        //echo $resultado;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.1</title>
</head>
<body>
    <form action="" method="post">
        <label for="num1">
            Número 1: 
            <input type="text" name="num1" id="num1">
        </label>
        <br>
        <label for="num2">
            Número 2: 
            <input type="text" name="num2" id="num2">
        </label>
        <br>
        <input type="submit" value="Sumar">
    </form>
    <?php
        if(isset($resultado)) echo "Resultado: $resultado.";
    ?>
</body>
</html>