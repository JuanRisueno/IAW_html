<!--Crea una función areaCirculo que reciba el radio de un círculo y calcule el área.-->

<?php
    require_once 'funciones-mias.php';
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if(isset($_POST['radio'])){
            $radio=($_POST['radio']);
            if(empty($radio)){
                $resultado = "<p>Error: Tienes que rellenar el campo radio</p>";
            }else{
                $resultado = areaCirculo($radio);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.2 mío</title>
</head>
<body>
    <h1>Ejercicio 3.2 mío</h1>
    <h2>Calcular el área de un círculo</h2>
    <form method="POST" action="">
        <label for="radio">
            Radio
            <input type="text" name="radio" id="radio"/>
        </label>
        <p><input type="submit" value="Calcular Área"/>
    </form>
    <?php
        if(isset($resultado)) echo "<p>Resultado: $resultado</p>"
    ?>
</body>
</html>