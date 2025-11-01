<!-- Crea una función generarSorteo que reciba el límite mínimo y máximo y genere un número
aleatorio para el sorteo de un evento.-->

<?php
    require_once 'funciones.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $min = $_POST['min'];
        $max = $_POST['max'];
        $sorteo = generarSorteo($min, $max);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 13 - Sorteo</h2>
    <form action="" method="post">
        <label for="min">
            Mínimo: 
            <input type="text" name="min" id="min" />
        </label>
        <label for="max">
            Máximo: 
            <input type="text" name="max" id="max" />
        </label>
        <input type="submit" value="Generar Sorteo">
    </form>
    <p><?php if(isset($sorteo)) echo "Número Premiado: $sorteo" ?></p>
</body>
</html>