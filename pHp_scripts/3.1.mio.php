<!--Crea una función suma que reciba dos números y devuelva su suma. Utiliza la función en un
script que reciba dos números y muestre el resultado.-->

<?php
    require_once 'funciones-mias.php';
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if(isset($_POST['num1']) && isset($_POST['num2'])){
            $n1 = $_POST['num1'];
            $n2 = $_POST['num2'];
            if(empty($n1)){
                $resultado = "<p>Error: Tienes que rellenar el campo Número 1</p>";
            }else if (empty($n2)){
                $resultado = "<p>Error: Tienes que rellenar el campon Número 2</p>";
            }else{
                $resultado = sumar($n1,$n2);
            }
        }
    }   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.1 mío</title>
</head>
<body>
    <h1>Ejercicio 3.1 mío</h1>
    <h2>Suma de 2 números</h2>
    <form action="" method="POST">
        <label for="num1">
            Número 1
            <input type="text" name="num1" id="num1"/>
        </label>
        <label for="num2">
            Número 2
            <input type="text" name="num2" id="num2"/>
        </label>
        <p><input type="submit" value="Sumar"/>
    </form>
    <?php
        if(isset($resultado)) echo "Resultado: <p>$resultado</p>";
    ?>
</body>
</html>