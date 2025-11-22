<!--Crea una función numDiasMes que reciba un año y un número de mes y devuelva cuántos días
tiene. Ten en cuenta que febrero puede ser bisiesto.-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mes = $_POST['mes'];
        $anyo = $_POST['anyo'];
        $r = numDiasMes($mes, $anyo);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Días del mes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 9 - Número de días de un mes</h2>
    <form action="" method="post">
        <label for="mes">
            Mes:
            <input type="text" name="mes" id="mes"/>
        </label>
        <label for="anyo">
            Año:
            <input type="text" name="anyo" id="anyo"/>
        </label>
        <input type="submit" value="Mostrar Días">
    </form>

    <p><?php if(isset($r)) echo "Resultado = $r" ?></p>
</body>
</html>