<!--
📜 La Puerta Secreta de Erebor Dificultad: ⭐⭐ (Media)
Nombre del archivo: 5_erebor.php

La compañía de Thorin Escudo de Roble ha llegado a la Ladera de la Montaña Solitaria. Es el Día de Durin y la última luz del sol está revelando la cerradura. Para entrar en el reino enano y recuperar el trono, debes demostrar que eres el legítimo Rey Bajo la Montaña introduciendo tu Nombre y la Palabra Clave.

Tu misión es crear un sistema de acceso:
El Guardián (Login): Un formulario que pida Usuario y Contraseña.
La Llave (Validación):
El sistema tiene unos datos fijos (hardcoded):
Usuario válido: "Thorin"
Contraseña válida: "Arkenstone"

Si el usuario acierta ambos, entra.

Si falla alguno, sale un mensaje de error: "No eres el Rey Bajo la Montaña".
El Reino (Sesión):
Si entra con éxito, se guarda en la sesión que está "dentro".
Importante: Una vez dentro, el formulario de login debe desaparecer y en su lugar debe salir un mensaje de bienvenida: "Bienvenido a Erebor, Rey Thorin".
Salir (Logout):

Estando dentro, debe haber un botón "Cerrar la Puerta" que destruya la sesión y te devuelva al formulario de entrada.-->
<?php 
    session_start();
    require_once '0_funciones.php';

    $errores=[];
    $nombre='';

    if(isset($_POST['volver'])){
        session_destroy();
        header('Location: 5_erebor.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = sanear($_POST['nombre'] ?? '');
        $pass = trim($_POST['pass'] ?? '');

        if(empty($nombre)){
            $errores['nombre'] = "Tienes que introducir un nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($pass)){
            $errores['pass'] = "Tienes que introducir una contraseña";
        }else{
            $passBien = $pass;
        }

        if(empty($errores)){
            if($nombreBien == "Thorin" && $passBien == "Arkenstone"){
                $_SESSION['rey'] = $nombreBien;
                header('Location: 5_erebor.php');
                exit;
            }else{
                $errores['general'] = "No eres el Rey (Credenciales Incorrectas)";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puerta de Erebor</title>
</head>
<body>
    <h1>PUERTA SECRETA DE EREBOR</h1>
    <h2>IDENTIFÍCATE</h2>
    
    <?php if(isset($_SESSION['rey'])): ?>
        <h2>Bienvenido a Casa, Thorin</h2>
        <form action="" method="POST">
                <p><input type="submit" name="volver" value="Volver"></p>
        </form>

    <?php else: ?>
        
        <?php if (isset($errores['general'])): ?>
            <h3><?= $errores['general'] ?></h3>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="nombre">
                Nombre:
                <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" value="<?= htmlspecialchars($nombre) ?? '' ?>">
                <?= $errores['nombre'] ?? '' ?>
            </label>
            <br><br>
            <label for="pass">
                Contraseña:
                <input type="password" name="pass" id="pass" placeholder="Introduce tu contraseña">
                <?= $errores['pass'] ?? '' ?>
            </label>
            <p><input type="submit" value="Enviar" name="enviar"></p>
        </form>
    <?php endif; ?>
</body>
</html>