<?php
    require_once 'iniciar_sesion.php';
    require_once 'no_logueado.php';
    require_once 'inactividad.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batcueva</title>
</head>
<body>
    <h1>Bienvenido <?=$_SESSION['user'] ?>. Archivos de la Liga de la Justicia cargados.</h1>
    <p><a href="pistas.php">Buscar Pistas</p>
    <p><a href="batmovil.php">Equipar Batmóvil</p>
    <p><a href="salir.php">Salir de la Batcueva</a></p>
</body>
</html>