<!--
⚔️ El Arsenal de Mordor - Solicitud de Equipo (8_arsenal.php)
Dificultad: ⭐⭐⭐ (Intermedio - Repaso de Estructuras)
Concepto: Validación de Formularios Complejos (Radio, Select, Checkbox) dentro de una Sesión Protegida.

Contexto:
Has logrado entrar en el Arsenal (login correcto). Ahora, como guardia de turno, debes rellenar el "Formulario de Requisa" para solicitar tu equipamiento diario antes de salir a patrullar.

Tu Misión:
Crear un formulario protegido que procese la solicitud de equipo.

Reglas del Sistema:
    1. Seguridad (El Portero):
        - Al igual que antes, si no existe $_SESSION['orco'], expulsar a '8_login.php'.

    2. El Formulario de Requisa:
        Debe recoger los siguientes datos:
        - Tipo de Misión (Radio Button): "Patrulla", "Guerra" o "Guardia". (Obligatorio).
        - Arma Principal (Select): "Cimitarra", "Arco", "Látigo". (Obligatorio).
        - Extras (Checkbox Array): "Raciones", "Veneno", "Cuerda". (Debe marcar al menos uno).

    3. Validación Estricta (Backend):
        - Debes validar que los valores recibidos existen en tus listas permitidas (Whitelists).
        - Debes validar que los campos obligatorios no están vacíos.

    4. Resultado:
        - Si todo es válido, muestra un resumen: "Solicitud aprobada para misión de [Misión]. Equipo entregado: [Arma] y [Extras]."
        - Si hay errores, muéstralos junto al formulario.

    5. Salida:
        - Botón para "Cerrar Turno" (Logout).
-->
<?php 
    require_once 'config_mordor.php';

    $errores = [];
    $mision = '';
    $arma = '';
    $extras = [];

    $misiones = ['patrulla','guerra','guardia'];
    $armas = ['cimitarra','arco','latigo'];
    $extrasValidos = ['raciones','veneno','cuerda'];

    if(!isset($_SESSION['orco'])){
        header('Location: 8_login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['terminar'])){
        
        $mision = $_POST['mision'] ?? '';
        $arma = $_POST['arma'] ?? '';
        $extras = $_POST['extras'] ?? [];

        if(empty($mision)){
            $errores['mision'] = "<br>Error: Elige misión.";
        } elseif(!in_array($mision, $misiones)){
            $errores['mision'] = "<br>Error: Misión inválida.";
        } else {
            $misionBien = $mision;
        }

        if(empty($arma)){
            $errores['arma'] = "<br>Error: Coge arma.";
        } elseif(!in_array($arma, $armas)){
            $errores['arma'] = "<br>Error: Arma inválida.";
        } else {
            $armaBien = $arma;
        }

        if(empty($extras)){
            $errores['extras'] = "<br>Error: Coge extras.";
        } elseif(!empty(array_diff($extras, $extrasValidos))){
            $errores['extras'] = "<br>Error: Extra prohibido.";
        } else {
            $extrasBien = $extras;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ARSENAL ORCO</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['orco']) ?></h1>

    <form action="" method="POST">
        <h3>Misión</h3>
        <label><input type="radio" name="mision" value="patrulla" <?php if($mision == 'patrulla') echo "checked"?>> Patrulla</label>
        <label><input type="radio" name="mision" value="guerra" <?php if($mision == 'guerra') echo "checked"?>> Guerra</label>
        <label><input type="radio" name="mision" value="guardia" <?php if($mision == 'guardia') echo "checked"?>> Guardia</label>
        <?= $errores['mision'] ?? '' ?>

        <h3>Arma</h3>
        <select name="arma">
            <option value="">Elije arma</option>
            <option value="cimitarra" <?php if($arma == 'cimitarra') echo 'selected' ?>>Cimitarra</option>
            <option value="arco" <?php if($arma == 'arco') echo 'selected' ?>>Arco</option>
            <option value="latigo" <?php if($arma == 'latigo') echo 'selected' ?>>Látigo</option>
        </select>
        <?= $errores['arma'] ?? '' ?>

        <h3>Extras</h3>
        <label><input type="checkbox" name="extras[]" value="raciones" <?php if(in_array('raciones', $extras)) echo "checked"?>> Raciones</label>
        <label><input type="checkbox" name="extras[]" value="veneno" <?php if(in_array('veneno', $extras)) echo "checked"?>> Veneno</label>
        <label><input type="checkbox" name="extras[]" value="cuerda" <?php if(in_array('cuerda', $extras)) echo "checked"?>> Cuerda</label>
        <?= $errores['extras'] ?? '' ?>
        
        <p><input type="submit" name="terminar" value="Tramitar"></p>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['terminar']) && empty($errores)): ?>
        <div style="border: 2px solid green; padding: 10px; margin-top: 20px;">
            <h2>¡Solicitud Aceptada!</h2>
            <p><strong>Orco:</strong> <?= htmlspecialchars($_SESSION['orco']) ?></p>
            <ul>
                <li><strong>Misión:</strong> <?= htmlspecialchars($misionBien) ?></li>
                <li><strong>Arma:</strong> <?= htmlspecialchars($armaBien) ?> </li>
                <li><strong>Extras:</strong> <?= htmlspecialchars(implode(", ", $extrasBien)) ?></li>
            </ul>
            
            <p>Ya tienes tu equipo. Ahora calcula las provisiones.</p>
            <form action="9_raciones.php" method="POST">
                <input type="submit" value="Ir a Logística (Siguiente Nivel) >>">
            </form>

        </div>
    <?php endif; ?>
    
    <?php 
        if(isset($_POST['logout'])){
            session_destroy();
            header('Location: 8_login.php');
            exit;
        }
    ?>
</body>
</html>