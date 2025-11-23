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

    if(!isset($_SESSION['orco'])){
        session_destroy();
        header('Location: 8_login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARSENAL ORCO</title>
</head>
<body>
    <h1>Bienvenido al Arsenal, <?= $_SESSION['orco'] ?></h1>
    <h2>Este es el equipo a tu disposición</h2>

    <form action="" method="POST">
        <h3>Elije tu misión</h3>
        <label for="patrulla"><input type="radio" name="mision" id='patrulla' value="patrulla"> Patrulla</label>
        <label for="guerra"><input type="radio" name="mision" id="guerra" value="guerra"> Guerra</label>
        <label for="guardia"><input type="radio" name="mision" id="guardia" value="guardia"> Guardia</label>
        <label for="arma">
            <h3>Elije tu arma principal</h3>
            <select name="arma" id="arma">
                <option value="">Elije tu arma</option>
                <option value="cimitarra">Cimitarra</option>
                <option value="arco">Arco</option>
                <option value="latigo">Látigo</option>
            </select>
        </label>
        <h3>Elije Extras (mínimo 1)</h3>
        <label for="raciones"><input type="checkbox" name="extras[]" id="raciones">Raciones</label>
        <label for="veneno"><input type="checkbox" name="extras[]" id="veneno">Veneno</label>
        <label for="cuerda"><input type="checkbox" name="extras[]" id="cuerda">Cuerda</label>
        <p><input type="submit" name="terminar" id="Terminar"></p>
    </form>
</body>
</html>