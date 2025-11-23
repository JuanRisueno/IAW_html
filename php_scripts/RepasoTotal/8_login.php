<!--
👁️ La Logística de Mordor - Fase 1 (8_login.php) Dificultad: ⭐⭐⭐ (Intermedio)
Concepto: Configuración Segura de Sesiones y Redirección entre archivos.

La Logística de Mordor: El Puesto de Guardia
El ejército de Sauron es inmenso y necesita organización. Los orcos deben "fichar" en el Puesto de Guardia antes de poder acceder al Arsenal de Armas. Si intentan colarse sin identificarse, serán despellejados.

Tu misión es crear la puerta de entrada segura al sistema.
Para ello, necesitas dos archivos trabajando en equipo:

1. 'config_mordor.php': El archivo de configuración que acabamos de crear.
2. '8_login.php': La página de identificación (este archivo).

Reglas del Puesto de Guardia:
    1. Seguridad Ante Todo: En lugar de usar session_start(), debes incluir el archivo de configuración al principio: require_once 'config_mordor.php';
    
    2. El Portero Automático (Redirección): 
        Al cargar la página, comprueba si ya existe la sesión del orco ($_SESSION['orco']).
        Si YA existe, no le muestres el formulario: usa header('Location: 8_arsenal.php') y exit para mandarlo directo al arsenal.

    3. Identificación: 
        Si no está identificado, muestra el formulario (Nombre y Contraseña).
        - Usuario válido: "Ugluk"
        - Contraseña válida: "carne"

    4. Acceso Concedido: 
        Si acierta las credenciales:
        - Guarda su nombre en $_SESSION['orco'].
        - Redirígelo inmediatamente a '8_arsenal.php'.-->

<?php 
    require_once '0_funciones.php';
    require_once 'config_mordor.php';
    
    if(isset($_SESSION['orco'])){
        header('Location:8_arsenal.php');
        exit;
    }
    
    $errores = [];
    $nombre = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['entrar'])){
        $nombre=sanear($_POST['nombre'] ?? '');
        $pass=trim($_POST['pass'] ?? '');

        if(empty($nombre)){
            $errores['nombre'] = "<br>Tienes que introducir un nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($pass)){
            $errores['pass'] = "Tienes que introducir una contraseña";
        }elseif (!preg_match("/^\w{5,}$/",$pass)){
            $errores['pass'] = "La contraseña tiene que ser de mínimo 5 caracteres que pueden ser letras, números o '_'";
        }else{
            $passBien = $pass;
        }

        if(empty($errores)){
            if($nombreBien == 'Ugluk' && $passBien == 'carne'){
                $_SESSION['orco'] = 'Ugluk';
                header('Location: 8_arsenal.php');
                exit;
            }else{
                $errores['general'] = '<br>Login Incorrecto (Credenciales malas)';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puesto de Guardia</title>
</head>
<body>
    <h1>Bienvenido al puesto de Guardia de Mordor</h1>
    <h2>Si quieres recoger tu equipo, tienes que logearte</h2>

    <?= $errores['general'] ?? '' ?>

    <form action="" method="POST">
        <p><input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" value="<?= htmlspecialchars($nombre ?? '') ?>"></p>
        <?= $errores['nombre'] ?? '' ?>
        <p><input type="password" name="pass" id="pass" placeholder="Contraseña"></p>
        <?= $errores['pass'] ?? '' ?>
        <p><input type="submit" name="entrar" id="Entrar"></p>
    </form>    
</body>
</html>