<!--
👁️ La Puerta Negra de Mordor (7_mordor.php) Dificultad: ⭐⭐ (Estándar)
Concepto: Autenticación (Login) comparando contra una lista de usuarios válidos (Array).

La Puerta Negra de Mordor
Frodo y Sam han llegado a la entrada de Mordor. La puerta está vigilada por orcos que piden identificación. Sin embargo, esta vez no hay un solo "Rey" (como en Erebor), sino que hay varios capitanes orcos que tienen permiso para entrar.

Tu misión es crear el sistema de control de acceso de la Puerta Negra.
El sistema debe permitir la entrada solo si el nombre del orco y su contraseña coinciden con alguno de los registros de la "Lista de Capitanes".

Reglas de Sauron:
    1. El formulario debe pedir: Nombre de Orco y Contraseña.
    2. Debes definir en tu código (PHP) una lista de usuarios válidos (Array Multidimensional). Para este ejercicio, aceptaremos a dos:
        - Usuario: "Shagrat", Contraseña: "rat"
        - Usuario: "Gorbag", Contraseña: "bag"
    3. Si el usuario introduce cualquiera de esos dos pares correctamente, entra.
    4. Si entra: Se guarda su nombre en la sesión, se oculta el formulario y se muestra: "Pasa, [Nombre]. Sauron te vigila."
    5. Debe haber un botón para "Salir de la Guardia" (Logout).-->

<?php 
    session_start();
    require_once '0_funciones.php';
    $errores=[];
    $nombre='';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar'])){
        session_destroy();
        header('Location: 7_mordor.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])){
        $nombre=sanear($_POST['nombre'] ?? '');
        $pass=trim($_POST['pass'] ?? '');

        if(empty($nombre)){
            $errores['nombre'] = "<br>¡¡¡Tienes que introducir un Nombre para entrar en Mordor!!!";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($pass)){
            $errores['pass'] = "<br>¡¡¡Tienes que introducir una Contraseña para entrar en Morder!!!";
        }elseif (!preg_match("/^\w{3,}$/",$pass)){
            $errores['pass'] = "<br>La contraseña solo puede estar rellena de letras, números o '_' y mínimo 3 caracteres";
        }else{
            $passBien = $pass;
        }

        if(empty($errores)){
            if($nombreBien == 'Shagrat' && $passBien== 'rat'){
                $_SESSION['nombre'] = 'Shagrat';
                $_SESSION['mordor'] = true;
                header('Location: 7_mordor.php');
                exit;
            }elseif ($nombreBien == 'Gorbag' && $passBien== 'bag'){
                $_SESSION['nombre'] = 'Gorbag';
                $_SESSION['mordor'] = true;
                header('Location: 7_mordor.php');
            }else{
                echo "<br>Login Incorrecto";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puerta Negra de Mordor</title>
</head>
<body>
    <h1>Bienvenido a la Puerta Negra de Mordor</h1>
    <h2>Solo personal autorizado podrá entrar</h2>

    <?php if(isset($_SESSION['mordor'])): ?>
        <h2>Bienvenido <?= $_SESSION['nombre'] ?>
        <form action="" method="POST">
            <p><input type="submit" name="cerrar" value="Cerrar las Puertas"></p>
        </form>
    <?php else: ?>

        <form action="" method="POST">
            <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" value="<?= htmlspecialchars($nombre ?? '') ?>">
            <?= $errores['nombre'] ?? '' ?>
            <input type="password" name="pass" id="pass" placeholder="Contraseña">
            <?= $errores['pass'] ?? '' ?>
            <p><input type="submit" name="entrar" value="Entrar en Mordor"></p>
        </form>
    <?php endif; ?>
</body>
</html>