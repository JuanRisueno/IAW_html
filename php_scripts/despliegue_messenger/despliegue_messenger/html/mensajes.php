<?php
    require_once 'bd.php';
    require_once 'conexion.php';
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
        exit;
    }

    $con = conectar();
    if($con === null)die('Error de conexion');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $seleccionados = $_POST['seleccionados'];

        foreach($seleccionados as $id){
            deleteMensaje($con,$id);
        }
    }
    
    $mensajes = findMensajes($con,$_SESSION['usuario']['id']);

    //var_dump([$_SESSION['usuario']]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OretaMessenger</title>
</head>
<body>
    <h1>Bienvenido <?= $_SESSION['usuario']['full_name'] ?></h1>
    <h2>Bandeja de entrada</h2>
    <form action="" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Asunto</th>
                    <th>Enviador por ...</th>
                    <th>Fecha</th>
                    <th>Leer</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach($mensajes as $m): ?>
                    <tr>
                        <td><input type="checkbox" name='seleccionados[]' value="<?= $m['id'] ?>"></td>
                        <td><?= $m['asunto'] ?></td>
                        <td><?= $m['remitente'] ?></td>
                        <td><?= $m['fecha'] ?></td>
                        <td><a href="">Leer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    <a href="cerrarSesion.php">Cerrar Sesión</a>
</body>
</html>