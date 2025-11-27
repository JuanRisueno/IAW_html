<!--
🔴 Ejercicio 1: "Inscripción al Gran Torneo" ⚔️🛡️
Archivos: torneo.php (Formulario) y funciones_torneo.php (Lógica). Puntuación: 6 Puntos.

📜 Instrucciones PHP:
1. Validaciones (torneo.php)
Debes validar que los datos llegan correctamente antes de calcular nada.

Reinicio: Si se pulsa el botón "Reiniciar Todo", la página debe recargarse limpia (usando header).

Caballero (Nombre): Obligatorio.
Email: Obligatorio. Formato válido (FILTER_VALIDATE_EMAIL).
Edad: Obligatorio. Entero (FILTER_VALIDATE_INT). Rango permitido: 16 a 60 años.
Peso de la Armadura: Obligatorio. Decimal (FILTER_VALIDATE_FLOAT).
Reino: Obligatorio. Debe ser uno de la lista válida.
Montura: Obligatorio.

Armas (Checkbox): Opcional. Si se marcan, validar que los valores existen.

Código de Escudero: Obligatorio.

Regex: Debe empezar por "ESC-" seguido obligatoriamente de 2 números (Ej: ESC-05, ESC-99).

2. Lógica de Negocio (funciones_torneo.php)
Crea la función calcularInscripcion(...) que reciba los datos y devuelva el coste total en monedas de oro.

Coste Base por Reino:
Ventormenta: 100 monedas.
Lordaeron: 80 monedas.
Gilneas: 90 monedas.

Sobrecarga de Armadura:
El peso estándar son 30kg.

Si la armadura pesa más de 30kg, se cobra 1 moneda extra por cada Kg de más.

(Ej: 35kg -> 5 monedas extra).

Suplemento de Armas: Suma el coste de las armas elegidas.

Espada: +10.
Lanza: +15.
Maza: +10.

Multiplicador de Montura:

Si elige Grifo, el coste acumulado hasta ahora (Reino + Peso + Armas) se multiplica por 2.
Si elige Caballo, el precio se mantiene.

Descuento Novato (Edad):

Si el caballero tiene menos de 20 años, se le descuentan 20 monedas al precio final del todo.

3. Resultado
Sticky Form: Si hay errores, el formulario debe mantener los datos escritos (nombre, selects, radios, checkboxes...).
Éxito: Si todo valida, muestra los datos limpios y el Precio Final.
-->
<?php
    require_once 'funciones.php';

    // Inicialización de variables
    $errores = [];
    $caballero = "";
    $email = "";
    $edad = "";
    $peso = "";
    $reino = "";
    $montura = "";
    $armas = []; // Array para los checkboxes
    $escudero = "";

    // Arrays de valores válidos (Listas blancas)
    $reinos_validos = ['ventormenta', 'lordaeron', 'gilneas'];
    $armas_validas = ['espada', 'lanza', 'maza'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // --- 0. LÓGICA DE REINICIO ---
        // Si pulsan limpiar... ¡vete a la página de inicio del torneo!
        if (isset($_POST['limpiar'])) {
            header('Location: ejercicio1.php'); // <--- Pon el nombre de TU archivo
            exit;
        }

        // --- 1. RECOGIDA Y SANEAMIENTO ---
        $caballero = trim($_POST['caballero'] ?? '');
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $edad = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT);
        // Permitimos decimales en el peso
        $peso = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $reino = $_POST['reino'] ?? '';
        $montura = $_POST['montura'] ?? '';
        $armas = $_POST['armas'] ?? []; // Si no marcan nada, llega array vacío
        $escudero = trim($_POST['escudero'] ?? '');

        // --- 2. VALIDACIONES ---

        // Nombre
        if (empty($caballero)) {
            $errores['caballero'] = "Debes indicar tu nombre, Sir.";
        } else {
            $caballeroBien = $caballero;
        }

        // Email
        if (empty($email)) {
            $errores['email'] = "El email es obligatorio.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errores['email'] = "Formato de email inválido.";
        } else {
            $emailBien = $email;
        }

        // Edad (16 - 60)
        if (empty($edad)) {
            $errores['edad'] = "Indica tu edad.";
        } elseif (filter_var($edad, FILTER_VALIDATE_INT) === false || $edad < 16 || $edad > 60) {
            $errores['edad'] = "Solo aceptamos caballeros entre 16 y 60 años.";
        } else {
            $edadBien = (int)$edad;
        }

        // Peso Armadura
        if (empty($peso)) {
            $errores['peso'] = "Indica el peso de tu armadura.";
        } elseif (filter_var($peso, FILTER_VALIDATE_FLOAT) === false) {
            $errores['peso'] = "El peso debe ser un número (puede tener decimales).";
        } else {
            $pesoBien = (float)$peso;
        }

        // Reino (Select)
        if (empty($reino)) {
            $errores['reino'] = "Elige tu reino de procedencia.";
        } elseif (!in_array($reino, $reinos_validos)) {
            $errores['reino'] = "Ese reino no participa en el torneo.";
        } else {
            $reinoBien = $reino;
        }

        // Montura (Radio)
        if (empty($montura)) {
            $errores['montura'] = "Debes elegir una montura.";
        } elseif ($montura != 'caballo' && $montura != 'grifo') {
            $errores['montura'] = "Montura ilegal.";
        } else {
            $monturaBien = $montura;
        }

        // Armas (Checkbox) - Opcional, pero si hay, que sean válidas
        if (!empty($armas)) {
            if (!empty(array_diff($armas, $armas_validas))) {
                $errores['armas'] = "Has intentado colar un arma prohibida.";
            }
        }
        // No hace falta 'else', si está vacío es válido (va a puños)

        // Código Escudero (Regex: ESC-00)
        if (empty($escudero)) {
            $errores['escudero'] = "Falta el código del escudero.";
        } elseif (!preg_match("/^ESC-\d{2}$/", $escudero)) {
            $errores['escudero'] = "Formato incorrecto. Debe ser ESC-XX (Ej: ESC-99).";
        } else {
            $escuderoBien = $escudero;
        }

        // --- 3. CÁLCULO FINAL ---
        if (empty($errores)) {
            $precioFinal = calcularInscripcion($reinoBien, $pesoBien, $monturaBien, $armas, $edadBien);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Torneo de Justas</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .container { background: white; padding: 20px; max-width: 600px; border: 3px solid #003366; margin: 0 auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        .error { color: red; font-size: 0.8em; }
        input[type="text"], select { width: 100%; padding: 5px; box-sizing: border-box; }
        .row { display: flex; gap: 20px; } .col { flex: 1; }
        input[type="submit"] { margin-top: 20px; padding: 10px 15px; cursor: pointer; font-weight: bold; }
        .btn-reset { background-color: #ffcccc; border: 1px solid red; margin-left: 10px; }
        .resultado { background-color: #e0f7fa; padding: 15px; border: 2px solid #006064; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>⚔️ Inscripción al Gran Torneo</h1>

    <form action="" method="post">
        
        <label>Nombre Caballero:</label>
        <input type="text" name="caballero" value="<?= htmlspecialchars($caballero) ?>">
        <span class="error"><?= $errores['caballero'] ?? '' ?></span>

        <label>Email de Contacto:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">
        <span class="error"><?= $errores['email'] ?? '' ?></span>

        <div class="row">
            <div class="col">
                <label>Edad (16-60):</label>
                <input type="text" name="edad" value="<?= htmlspecialchars($edad) ?>">
                <span class="error"><?= $errores['edad'] ?? '' ?></span>
            </div>
            <div class="col">
                <label>Peso Armadura (Kg):</label>
                <input type="text" name="peso" value="<?= htmlspecialchars($peso) ?>">
                <span class="error"><?= $errores['peso'] ?? '' ?></span>
            </div>
        </div>

        <label>Reino de Origen:</label>
        <select name="reino">
            <option value="">Selecciona...</option>
            <option value="ventormenta" <?= ($reino == 'ventormenta') ? 'selected' : '' ?>>Ventormenta (100)</option>
            <option value="lordaeron" <?= ($reino == 'lordaeron') ? 'selected' : '' ?>>Lordaeron (80)</option>
            <option value="gilneas" <?= ($reino == 'gilneas') ? 'selected' : '' ?>>Gilneas (90)</option>
        </select>
        <span class="error"><?= $errores['reino'] ?? '' ?></span>

        <label>Montura:</label>
        <input type="radio" name="montura" value="caballo" <?= ($montura == 'caballo') ? 'checked' : '' ?>> Caballo de Guerra
        <input type="radio" name="montura" value="grifo" <?= ($montura == 'grifo') ? 'checked' : '' ?>> Grifo (x2 Precio)
        <br><span class="error"><?= $errores['montura'] ?? '' ?></span>

        <label>Armas Registradas:</label>
        <input type="checkbox" name="armas[]" value="espada" <?= in_array('espada', $armas) ? 'checked' : '' ?>> Espada (+10)<br>
        <input type="checkbox" name="armas[]" value="lanza" <?= in_array('lanza', $armas) ? 'checked' : '' ?>> Lanza (+15)<br>
        <input type="checkbox" name="armas[]" value="maza" <?= in_array('maza', $armas) ? 'checked' : '' ?>> Maza (+10)
        <br><span class="error"><?= $errores['armas'] ?? '' ?></span>

        <label>Código de Escudero (Ej: ESC-01):</label>
        <input type="text" name="escudero" value="<?= htmlspecialchars($escudero) ?>">
        <span class="error"><?= $errores['escudero'] ?? '' ?></span>

        <br>
        <input type="submit" name="enviar" value="Calcular Inscripción">
        <input type="submit" name="limpiar" value="🗑️ Reiniciar Todo" class="btn-reset">
    </form>

    <?php if (isset($precioFinal)): ?>
        <div class="resultado">
            <h2>📜 Inscripción Aprobada</h2>
            <p><strong>Caballero:</strong> <?= htmlspecialchars($caballeroBien) ?></p>
            <p><strong>Reino:</strong> <?= ucfirst($reinoBien) ?></p>
            <p><strong>Escudero Asignado:</strong> <?= htmlspecialchars($escuderoBien) ?></p>
            <hr>
            <h3>COSTE TOTAL: <?= $precioFinal ?> Monedas de Oro</h3>
        </div>
    <?php endif; ?>

</div>
</body>
</html>