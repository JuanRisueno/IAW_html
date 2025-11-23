<!--
AVISO A STALKERS!!! Este script realmente no lo he hecho yo, jajaja. Este si lo ha hecho la IA. Pero quería hacer algo chulo cuando el orco llegase al Arsenal jejeje.

⚔️ La Logística de Mordor - Fase 2 (8_arsenal.php)
Dificultad: ⭐⭐⭐⭐ (Avanzado)
Concepto: Gestión de Arrays Asociativos, Lógica de Estado Visual y Flujo de Completado.

El Arsenal de Mordor: Equipando a Ugluk
Has entrado en la zona restringida. Pero un orco no puede ir a la guerra desnudo.
Tu misión es equipar al guardia (Ugluk) con las 4 piezas fundamentales de la armadura de Mordor.

Reglas del Arsenal:
    1. Seguridad (El Portero):
        - Cargar 'config_mordor.php'.
        - Si no existe $_SESSION['orco'], expulsar a '8_login.php'.

    2. El Catálogo (Arrays):
        - Debes definir 4 arrays con opciones fijas:
         * Armas (ej: Cimitarra, Arco...)
         * Cascos
         * Pechos (Armaduras)
         * Escudos

    3. Mecánica de Equipamiento (La Memoria):
        - El equipo se guardará en $_SESSION['equipo'], que será un array asociativo.
        - Ejemplo: $_SESSION['equipo']['arma'] = "Cimitarra";

    4. Interfaz Dinámica (Lo visual):
        - Muestra la lista de lo que Ugluk ya lleva puesto.
        - Muestra 4 formularios de selección (uno por categoría), PERO con una condición:
         * Si Ugluk YA tiene un 'casco' en la sesión, el formulario de cascos DESAPARECE.
         * Si NO tiene 'arma', el formulario de armas APARECE.

    5. Orco Preparado (Salida):
        - El botón de "Salir" (Logout) está bloqueado.
        - Solo aparecerá cuando Ugluk tenga las 4 piezas equipadas (count($_SESSION['equipo']) == 4).
        - Al pulsarlo, destruye la sesión y vuelve al login.
-->

<?php 
    require_once 'config_mordor.php'; // Inicia sesión segura
    // require_once '0_funciones.php'; // Si necesitas sanear, aunque aquí usaremos selects cerrados

    // 1. PORTERO
    if(!isset($_SESSION['orco'])){
        header('Location: 8_login.php');
        exit;
    }

    // 2. LOGOUT (Orco Preparado)
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['preparado'])){
        session_destroy();
        header('Location: 8_login.php');
        exit;
    }

    // 3. CATÁLOGO (Tus arrays fijos)
    $armas   = ['Cimitarra', 'Arco de Tejo', 'Maza de Pinchos'];
    $cascos  = ['Casco de Hierro', 'Capucha de Cuero', 'Yelmo Oxidado'];
    $pechos  = ['Cota de Malla', 'Peto de Acero', 'Harapos de Orco'];
    $escudos = ['Escudo Redondo', 'Escudo Torre', 'Tapa de Barril'];

    // 4. INICIALIZAR EQUIPO
    if(!isset($_SESSION['equipo'])){
        $_SESSION['equipo'] = []; // Array vacío
    }

    // 5. LÓGICA DE EQUIPAR (Coger ítem)
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['equipar'])){
        
        $categoria = $_POST['categoria'] ?? ''; // "arma", "casco", etc.
        $objeto = $_POST['objeto'] ?? '';

        // Validación básica: ¿El objeto existe en tu array original?
        // (Aquí simplificamos, pero podrías usar in_array para seguridad máxima)
        if($categoria && $objeto) {
            $_SESSION['equipo'][$categoria] = $objeto;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Arsenal de Mordor</title>
</head>
<body>
    <h1>Arsenal de Mordor</h1>
    <h2>Guardia de turno: <?= htmlspecialchars($_SESSION['orco']) ?></h2>

    <h3>Tu Equipamiento Actual:</h3>
    <ul>
        <?php if(empty($_SESSION['equipo'])): ?>
            <li>Estás desnudo, gusano. ¡Equípate!</li>
        <?php else: ?>
            <?php foreach($_SESSION['equipo'] as $cat => $item): ?>
                <li><strong><?= ucfirst($cat) ?>:</strong> <?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <hr>

    <?php if(!isset($_SESSION['equipo']['arma'])): ?>
        <form action="" method="POST">
            <label>Elige tu Arma:</label>
            <select name="objeto">
                <?php foreach($armas as $a): ?>
                    <option value="<?= $a ?>"><?= $a ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="categoria" value="arma">
            <input type="submit" name="equipar" value="Coger Arma">
        </form>
        <br>
    <?php endif; ?>

    <?php if(!isset($_SESSION['equipo']['casco'])): ?>
        <form action="" method="POST">
            <label>Elige tu Casco:</label>
            <select name="objeto">
                <?php foreach($cascos as $c): ?>
                    <option value="<?= $c ?>"><?= $c ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="categoria" value="casco">
            <input type="submit" name="equipar" value="Poner Casco">
        </form>
        <br>
    <?php endif; ?>

    <?php if(!isset($_SESSION['equipo']['pecho'])): ?>
        <form action="" method="POST">
            <label>Elige tu Pecho:</label>
            <select name="objeto">
                <?php foreach($pechos as $p): ?>
                    <option value="<?= $p ?>"><?= $p ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="categoria" value="pecho">
            <input type="submit" name="equipar" value="Poner Pecho">
        </form>
        <br>
    <?php endif; ?>

    <?php if(!isset($_SESSION['equipo']['escudo'])): ?>
        <form action="" method="POST">
            <label>Elige tu Escudo:</label>
            <select name="objeto">
                <?php foreach($escudos as $e): ?>
                    <option value="<?= $e ?>"><?= $e ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="categoria" value="escudo">
            <input type="submit" name="equipar" value="Coger Escudo">
        </form>
        <br>
    <?php endif; ?>

    <?php if(count($_SESSION['equipo']) == 4): ?>
        <div style="background-color: #e6ffe6; padding: 10px; border: 1px solid green;">
            <h3>¡Estás listo para la guerra!</h3>
            <form action="" method="POST">
                <input type="submit" name="preparado" value="ORCO PREPARADO (SALIR)">
            </form>
        </div>
    <?php endif; ?>

</body>
</html>