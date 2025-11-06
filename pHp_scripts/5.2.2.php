<?php
    session_start();
    
    if (!isset($_SESSION['user'])){
        header("Location:5.2.php");
    }
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
    <p><a href="5.1.php">Buscar Pistas</p>
    <p><a href="5.2.3.php">Salir de la Batcueva</a></p>
</body>
</html>