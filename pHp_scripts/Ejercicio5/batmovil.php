<!--Misión 5: Asegurando la Bat-Señal (Configuración Segura)
🎯Objetivo:
Aplicar las buenas prácticas de seguridad y configuración avanzada de sesiones.
🦇Escenario:
Alfred ha detectado intentos de "fijación de sesión" de Scarecrow y ataques XSS de "Mr. Click".
¡Es hora de blindar la Bat-computadora!
📝 Misión:
Toma de nuevo la Misión 2 (Login) y "blíndala" profesionalmente.
• Crea un archivo config_batman.php.
• Mueve el session_start() allí, pero antes de llamarlo, añade esto:
◦ Dale un nombre a la sesión para que no sea el PHPSESSID por defecto. ¡Que se llame
BatSignal!: session_name('BatSignal');
◦ Configura los parámetros de la cookie para que sea httponly = true (para parar a "Mr.
Click"). session_set_cookie_params(0, '/', 'localhost', false, true);
◦ (Añade un comentario explicando que secure se pondría a true en un servidor real
con HTTPS).
◦ Ahora, modifica todas las páginas que usan sesiones (es decir, login.php,
batcueva.php, salir.php y batmovil.php) para que usen require_once
'config_batman.php'; en lugar del session_start() simple.
◦ En login.php, justo después de comprobar que la contraseña es correcta (y antes de
redirigir), añade la defensa contra Scarecrow: session_regenerate_id(true);-->

<?php
    require_once 'iniciar_sesion.php';
    require_once 'no_logueado.php';
    require_once 'inactividad.php';
    //Consultado a BD
    $gadgets_disp = ["Batarang","Ganzúa Láser","Bomba de Humo","Gel Explosivo", "Capa Deslizante",];
    
    $_SESSION['gadgets'] = $_SESSION['gadgets'] ?? [];

    if(isset($_POST['Equipar'])){
        foreach($_POST['gadgets_add'] as $g){
            #$_SESSION['gadgets'][$g] = ($_SESSION['gadgets'][$g] && 0) +1;
            if (!isset($_SESSION['gadgets'][$g])){
                $_SESSION['gadgets'][$g] = 1;
            }else{
                $_SESSION['gadgets'][$g] += 1;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batmovil</title>
</head>
<body>
    <h1>Equipa el Batmovil</h1>
    <h2>Gadgets Disponibles</h2>
    <form action="" method="post">
        <?php foreach($gadgets_disp as $g):?>
        <label for="<?= $g ?>">
            <input type="checkbox" name="gadgets_add[]" id="<?= $g ?>" value="<?= $g ?>">
            <?= $g ?>
        </label>
        <?php endforeach; ?>
        <p><input type="submit" value="Equipar" name="Equipar"></p>
    </form>
    <h2>Elementos Añadidos</h2>
    <?php foreach($_SESSION['gadgets'] as $nombre_gadget => $cantidad):?>
        <p>
            <?= $nombre_gadget ?> (Cantidad: <?= $cantidad ?>)
        </p>
    <?php endforeach; ?>
</body>
</html>