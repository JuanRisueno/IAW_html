<!-- Crea una función obtenerDivisores que reciba un número y determine cuántos divisores tiene
y los muestre.-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $num = $_POST['num'];
        $divisores = obtenerDivisores($num);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener divisores</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 11 - Obtener divisores de un número</h2>
    <form action="" method="post">
        <label for="num">
            Número: 
            <input type="text" name="num" id="num"/>
        </label>
        <input type="submit" value="Obtener divisores">
    </form>

    <?php if(isset($divisores)){
        echo "<p>Número de divisores: ".count($divisores)."</p>"; 
        echo "Divisores: ";
        foreach($divisores as $divisor){
            echo "$divisor ";
        }
        echo "</p>";
    }  
    ?>
</body>
</html>