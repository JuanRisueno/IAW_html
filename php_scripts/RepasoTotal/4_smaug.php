<!--
🐉 El Tesoro de Smaug (4_smaug.php) Dificultad: ⭐⭐ (Media)
Concepto: Repaso general. Acumuladores, promedios, validación de 0 y botón de pánico.

Bilbo Bolsón se ha infiltrado en la Montaña Solitaria. El dragón Smaug duerme sobre una montaña de oro, y Bilbo, haciendo honor a su título de "Saqueador", está intentando calcular cuánto oro hay allí, puñado a puñado.

Tu misión es crear una herramienta para que Bilbo vaya registrando lo que ve:

El Saqueo: Bilbo estima la cantidad de Monedas de Oro que ve en un montón y la introduce en el formulario.
Validación: Debe ser un número entero y positivo (no existen montones de -5 monedas). Si deja el campo vacío o pone letras, el sistema debe avisarle en silencio (mensaje de error).
La Cuenta (Sesión): El sistema debe ir sumando las monedas a un Total Acumulado y también contar cuántos montones ha registrado Bilbo hasta el momento.
Estadísticas: Muestra en pantalla:
Total de monedas contadas.
Número de montones registrados.
Promedio: La media de monedas por montón (Total Monedas / Total Montones). Usa number_format para que quede bonito.

El Despertar (Limpieza):
Si Bilbo recarga la página (F5/Enter en URL), el miedo le hace olvidar la cuenta (la sesión se borra).

Debe haber un botón de pánico "¡Smaug Despierta!" que también borre todo manualmente.-->
<?php
    session_start();
    $errores=[];
    $monedas="";
    $monedasBien=0;

    if(!isset($_POST['suma']) && !isset($_POST['smaug'])){
        session_destroy();
        session_start();
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['smaug'])){
        session_destroy();
        header('Location: 4_smaug.php');
        exit;
    }

    if(!isset($_SESSION['monedasTotales'])){
        $_SESSION['monedasTotales'] = 0;
        $_SESSION['montones'] = 0;
        $_SESSION['promedio'] = 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['monedas'])){
        $monedas=filter_var($_POST['monedas'] ?? '',FILTER_SANITIZE_NUMBER_INT);
        
        if($monedas === ''){
            $errores['monedas'] = "Tienes que introducir al menos 1 moneda";
        }elseif (filter_var($monedas,FILTER_VALIDATE_INT) === false){
            $errores['monedas'] = "Las monedas tienen que ser un número entero";
        }elseif ($monedas <= 0){
            $errores['monedas'] = "Las monedas siempre son mayores de 0";
        }else{
            $monedasBien = $monedas;
        }

        if(empty($errores)){
            $_SESSION['montones'] += 1;
            $_SESSION['monedasTotales'] += $monedasBien;
            $_SESSION['promedio'] = $_SESSION['monedasTotales'] / $_SESSION['montones'];

            $monedas='';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caverna de Smaug</title>
</head>
<body>
    <h1>¡CUANTO ORO TE PUEDES LLEVAR ANTES DE QUE SMAUG DESPIERTE!</h1>
    <form action="" method="POST">
        <label for="monedas">
            Monedas de Oro: 
            <input type="text" name="monedas" id="monedas" placeholder="Monedas de oro" value="<?= htmlspecialchars($monedas) ?? '' ?>">
            <?= $errores['monedas'] ?? '' ?>
        </label>
        <p><input type="submit" name="suma" value="Suma las monedas"></p>
    </form>
    <h2>Cantidad Robada a Smaug</h2>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['monedas'])): ?>
        <p>Número de monedas: <?= $monedasBien ?> Monedas.</p>
    <?php endif;?>
    <p>Número de montones: <?=  $_SESSION['montones'] ?> Montones.</p>
    <p>Número total monedas: <?=  $_SESSION['monedasTotales'] ?> Monedas. </p>
    <p>Promedio de monedas cogidas: <?=  (number_format($_SESSION['promedio'],2)) ?> monedas por montón</p>

    <form action="" method="POST">
        <input type="submit" value="SMAUG DESPIERTA" name="smaug">
    </form>
</body>
</html>