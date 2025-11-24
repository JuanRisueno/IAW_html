<?php
    session_name('subasta');
    session_start();

    if(!isset($_SESSION['subasta']) || ($_SESSION['subasta'] !== true)){
        header('Location: 8_salir_subasta.php');
        exit;
    }

    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['salir']))){
        header('Location: 8_salir_subasta.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa de Subastas</title>
</head>
<body>
    <h1>Bienvenido <?= htmlspecialchars($_SESSION['nombre']) ?></h1>

    <form action="" method="POST">
        <input type="submit" name="salir" value="Salir">
    </form>
</body>
</html>