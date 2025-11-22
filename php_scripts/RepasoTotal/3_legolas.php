<!--
🏹 La Puntería de Legolas (3_legolas.php) Dificultad: ⭐⭐ (Media)
Concepto: Calcular medias (Promedio).

Legolas Verda hoja está entrenando su tiro con arco para la batalla del Abismo de Helm. Gimli le está picando, diciéndole que no es tan bueno como dice. Para callarle la boca, Legolas necesita un registro de sus puntuaciones.

Tu misión es crear un formulario de registro de tiros:
El Disparo: Legolas introduce la Puntuación de su última flecha (un número entero entre 0 y 10).

Validación: El número debe ser válido. No puede ser menor de 0 (fallo total) ni mayor de 10 (diana perfecta).
La Memoria: Cada puntuación válida se guarda en la sesión ($_SESSION['flechas']). Es una lista simple de números (Array).
Estadísticas: Debajo del formulario, debes mostrar en tiempo real:
Flechas lanzadas: (Cuenta total).
Puntuación Total: (Suma de todos los puntos).
Puntería Media: (La media aritmética: Total Puntos / Total Flechas). Ojo: Si no ha tirado flechas, la media es 0 para evitar error de división por cero.

Reiniciar: Un botón para "Empezar nueva ronda" (Borrar datos).-->
<?php 
    session_start();
    $errores=[];
    $puntuacion='';

    if(!isset($_SESSION['puntuacionTotal'])){
        $_SESSION['puntuacionTotal'] = 0;
        $_SESSION['flechas'] = 0;
        $_SESSION['precision'] = 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reiniciar'])){
        session_destroy();
        header('Location: 3_legolas.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['puntuacion'])){
        $puntuacion=filter_var($_POST['puntuacion'] ?? '',FILTER_SANITIZE_NUMBER_INT);

        if($puntuacion === ''){
            $errores['puntuacion'] = "Tienes que introducir una puntuación entre 0 y 10";
        }elseif (filter_var($puntuacion,FILTER_VALIDATE_INT) === false){
            $errores['puntuacion'] = "La puntuación tiene que ser un número entero entre 0 y 10";
        }elseif ($puntuacion < 0 || $puntuacion > 10){
            $errores['puntuacion'] = "La puntaución tiene estar entre 0 y 10";
        }else{
            $puntuacionBien = $puntuacion;
        }

        if(empty($errores)){
            $_SESSION['flechas'] += 1;
            $_SESSION['puntuacionTotal'] += $puntuacionBien;
            $_SESSION['precision'] = $_SESSION['puntuacionTotal'] / $_SESSION['flechas'];

            $puntuacion='';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campo de Práctica</title>
</head>
<body>
    <h1>Práctica de Légolas</h1>
    <form action="" method="POST">
        <label for="disparo">
            Puntuación del disparo (0-10): 
            <input type="text" name="puntuacion" id="puntuacion" placeholder="Puntuación" value="<?= htmlspecialchars($puntuacion) ?? ''?>" >
            <?= $errores['puntuacion'] ?? '' ?>
        </label>
        <p><input type="submit" value="Añadir Puntación"></p>
    </form>
    <p>Puntuación de Légolas:</p>
    <ul>
        <?php if($_SERVER['REQUEST_METHOD'] && isset($puntuacionBien)): ?>   
            <li>Puntuación Último Disparo: <?php echo $puntuacionBien ?>
        <?php endif; ?>
        <li>Puntuación Total: <?php echo $_SESSION['puntuacionTotal'] ?></li>
        <li>Número de flechas usadas: <?php echo $_SESSION['flechas'] ?> Flecha(s)</li>
        <li>Precisión en la Sesión: <?php echo number_format($_SESSION['precision'], 2) ?></li>
    </ul>
    <form action="" method="POST">
        <input type="submit" name="reiniciar" value="Reiniciar práctica">
    </form>
</body>
</html>