<!--
🍖 La Marcha de los Orcos (9_raciones.php)
Dificultad: ⭐⭐ (Estándar - Funciones de Cálculo)
Concepto: Uso de Funciones con Parámetros y Retorno (return) para cálculos matemáticos.

Contexto:
Ugluk ya tiene su armadura (del ejercicio 8). Ahora lidera un grupo de orcos hacia Isengard.
El viaje es largo y los orcos tienen hambre. "¡Hace días que no catamos carne fresca!".
Como capitán, Ugluk debe calcular cuántas raciones de pan mohoso necesita cargar.

Tu Misión:
Crear una calculadora logística usando una función propia.

Reglas:
    1. Seguridad:
        - Cargar 'config_mordor.php'.
        - Si no hay orco logueado ($_SESSION['orco']), expulsar al login.

    2. El Formulario:
        - Input (Entero): Número de Orcos en el escuadrón.
        - Input (Entero): Días de viaje estimados.

    3. La Función (en '0_funciones.php'):
        - Crea una función llamada 'calcularSuministros($orcos, $dias)'.
        - La fórmula es: Cada orco come 3 panes al día.
        - Debe devolver (return) el total de panes necesarios.

    4. Resultado:
        - Muestra: "Para X orcos y Y días, necesitas cargar Z panes mohosos".
        - Muestra un botón "Iniciar Marcha" (Logout final).
-->

<?php 
    require_once 'config_mordor.php';
    require_once '0_funciones.php';
    $errores = [];
    $numOrcos = '';
    $numDias = '';

    if(!isset($_SESSION['orco'])){
        session_destroy();
        header('Location: 8_login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])){
        $numOrcos = filter_var($_POST['numOrcos'],FILTER_SANITIZE_NUMBER_INT);
        $numDias = filter_var($_POST['numDias'],FILTER_SANITIZE_NUMBER_INT);

        if(empty($numOrcos)){
            $errores['numOrcos'] = "Tienes que rellenar el número de orcos del escuadrón";
        }elseif (filter_var($numOrcos,FILTER_VALIDATE_INT) === false){
            $errores['numOrcos'] = "Tiene que ser un número entero!";
        }else{
            $numOrcosBien = $numOrcos;
        }

        if(empty($numDias)){
            $errores['numDias'] = "Tienes que rellenar el número de días";
        }elseif (filter_var($numDias,FILTER_VALIDATE_INT) === false){
            $errores['numDias'] = "Tiene que ser un número entero!";
        }else{
            $numDiasBien = $numDias;
        }

        if(empty($errores)){
            $totalPanes = calcularSuministros($numOrcosBien, $numDiasBien);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística</title>
</head>
<body>
    <h1>NOS VAMOS A LA GUERRA!!!</h1>
    <h2>Cuanta comida tenemos que llevarnos?</h2>
    
    <form action="" method="POST">
        <label for="numOrcos">Número de Orcos en el escuadrón 
            <input type="text" name="numOrcos" id="numOrcos" value="<?= htmlspecialchars($numOrcos ?? '') ?>" >
            <?= $errores['numOrcos'] ?? '' ?>
        </label>
        <p><label for="numDias">Número de Días de viaje 
            <input type="text" name="numDias" id="numDias"value="<?= htmlspecialchars($numDias ?? '') ?>" >
            <?= $errores['numDias'] ?? '' ?>
        </label></p>
        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>

    <?php if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['enviar']) && empty($errores)): ?>
        <form action="" method="POST">
            Las raciones necesarias son: <?= htmlspecialchars($totalPanes) ?>
            <p><input type="submit" name="continuar" value="Continuamos la aventura"></p>
        </form>
    <?php endif; ?>
</body>
</html>