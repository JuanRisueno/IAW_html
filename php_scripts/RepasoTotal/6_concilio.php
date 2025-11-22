<!--
💍 El Concilio de Elrond (6_concilio.php) Dificultad: ⭐⭐ (Fácil)
Concepto: Guardar una lista simple (Array) en la sesión y evitar duplicados.

El Concilio de Elrond
Has logrado cruzar Moria y llegas a Rivendel. Allí, Lord Elrond está convocando un concilio secreto. Necesita hacer una lista de los miembros que formarán la "Comunidad del Anillo".

Tu misión es crear un formulario para ir inscribiendo a los voluntarios uno a uno.
Cada vez que escribas un nombre y pulses "Unirse", ese nombre debe guardarse en una lista mágica (un array en la sesión).
La lista debe mostrarse debajo del formulario, creciendo con cada nuevo miembro (Frodo, Aragorn, Legolas...).
Reglas de Elrond:
    No se admiten nombres vacíos.
    No se admiten duplicados: Si "Legolas" ya está en la lista, no puede unirse otra vez (Elrond es estricto con esto).
    Debe haber un botón final que diga "Disolver la Comunidad" (Cerrar Sesión/Borrar lista) para empezar de cero.-->

<?php 
    session_start();
    require_once '0_funciones.php';

    $errores=[];
    $miembro='';
    
    //Para reiniciar la sensión
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['disolver'])){
        session_destroy();
        header("Location: 6_concilio.php");
        exit;
    }

    //Se inicial el array
    if (!isset($_SESSION['comunidad'])){
        $_SESSION['comunidad'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['miembro'])){
        $miembro=sanear($_POST['miembro']) ?? '';

        if(empty($miembro)){
            $errores['miembro'] = "No puedes añadir un nombre vacío.";
        }elseif (existe($miembro,$_SESSION['comunidad'])){
            $errores['miembro'] = 'Ese miembro ya está en la lista.';
        }else{
            $_SESSION['comunidad'][] = $miembro;
            $miembro='';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concilio de Elrond</title>
</head>
<body>
    <h1>Bienvenidos al Concilio de Elrond, en Rivendel</h1>

    <form method="post" action="">
        <h2>Añadir miembro.</h2>
        <label for="nombreMiembro">Nombre del miembro a añadir.</label>
        <p><input type="text" name="miembro" id="miembro" placeholder="Miembro a añadir" value="<?= htmlspecialchars($miembro) ?>"></p>
        <?= $errores['miembro'] ?? '' ?>
        
        <p><input type="submit" value="Añadir"></p>
    </form>

    <form method="POST" action="">
        <p><input type="submit" name="disolver" value="Disolver"></p>
    </form>

    <h2>Lista de miembros de la Comunidad del Anillo</h2>
    <ul>
        <?php foreach($_SESSION['comunidad'] as $heroe): ?>
            <li><?= htmlspecialchars($heroe) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>