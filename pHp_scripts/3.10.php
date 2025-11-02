<!--Crea una función convertirSegundos que reciba una cantidad de segundos y lo convierta a
horas, minutos y segundos-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $seg = $_POST['segundos'];
        $r = convertirSegundos($seg);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertidor de segundos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 10 - Convertir segundos a horas, minutos y segundos</h2>
    <form action="" method="post">
        <label for="segundos">
            Segundos:
            <input type="text" name="segundos" id="segundos"/>
        </label>
        <input type="submit" value="Mostrar Días">
    </form>

    <p><?php if(isset($r)) echo $r ?></p>
</body>
</html>