<!--Ejercicio 1: El Recluta de la Hermandad ⚔️
Nombre del archivo: recluta_hermandad.php
Dificultad: ⭐ (1/5)
Conceptos Clave: Creación de formulario HTML, manejo de variables $_POST, verificación de envío ($_SERVER["REQUEST_METHOD"]), uso de isset() para radio buttons.

Trasfondo: Declaración de Rol
El Consejo de Guerra de tu Hermandad está realizando un registro básico de nuevos miembros. Es crucial saber el nombre del recluta y, obligatoriamente, qué rol principal asumirá en la próxima raid (incursión).
Debes crear un único archivo (recluta_hermandad.php) que contenga tanto el formulario HTML como el script PHP que lo procesa.
📝 Tarea de PHP y HTML (recluta_hermandad.php):

I. Formulario (HTML)
El formulario debe incluir:
1. Un campo de texto (input type="text") con name="nombre_personaje" para el nombre del recluta.
2. Un grupo de radio buttons para elegir el rol. Todos deben compartir el atributo name="rol". Las opciones deben ser: Tanque, Daño Cuerpo a Cuerpo, Daño a Distancia y Sanador (debes asignarles un value adecuado, por ejemplo, "tank", "dps_melee", etc.).
3. Un botón de envío.

II. Script (PHP)
El script PHP debe procesar el formulario enviado (verificando $_SERVER["REQUEST_METHOD"] == 'POST') y realizar las siguientes verificaciones, basándose en la lógica del Ejercicio 1 de la Relación 4:
1. Verificación de Rol Obligatorio: Debe verificar si se seleccionó una opción de rol utilizando la función isset() en el array $_POST['rol'].
2. Resultado:
    ◦ Si se seleccionó un rol y se introdujo un nombre, debe mostrar: "¡Recluta [Nombre] aceptado! Tu rol principal es: [Rol Elegido]".
    ◦ Si NO se seleccionó un rol, debe mostrar un mensaje de error: "Error: Debes elegir un rol principal para ser aceptado."
-->

<?php 
    $errores = [];
    $nombre = "";
    $rol = "";
    $roles = ['tank','heal','dpsMelee','dpsCaster'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre'] ?? '');
        $rol = ($_POST['rol'] ?? '');

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que rellenar el nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($rol)){
            $errores['rol'] = "Error: Debes elegir un rol principal para ser aceptado.";
        }elseif (!in_array($rol,$roles)){
            $errores['rol'] = "Error: Tienes que elegir solo uno de los roles facilitados";
        }else{
            $rolBien = $rol;
        }

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclutamiento de Hermandad</title>
</head>
<body>
    <h1>Travellers of Worlds</h1>
    <h2>Apply de reclutamiento</h2>

    <form action="" method="POST">
        <label for="nombre">
            Nombre del Jugador 
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del jugador" value="<?= htmlspecialchars($nombre ?? '') ?>" >
        </label>
        <p><?= $errores['nombre'] ?? '' ?> </p>
        
        <p>Elige tu rol (Puedes elegir solo 1 rol):</p>
        <p><label for="tank"><input type="radio" name="rol" id="tank" value="tank" <?php if($rol == 'tank') echo 'checked' ?> >Tanque</label>
        <label for="heal"><input type="radio" name="rol" id="heal" value="heal" <?php if($rol == 'heal') echo 'checked' ?>>Heal</label>
        <label for="dpsMelee"><input type="radio" name="rol" id="dpsMelee" value="dpsMelee" <?php if($rol == 'dpsMelee') echo 'checked' ?> >DPS Melee</label>
        <label for="dpsCaster"><input type="radio" name="rol" id="dpsCaster" value="dpsCaster" <?php if($rol == 'dpsCaster') echo 'checked' ?>>DPS Caster</label></p>
        
        <p><input type="submit" name="enviar" id="enviar" value="Enviar"></p>
    </form>

    <?php if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['enviar'])) && (empty($errores))): ?>
        Bienvenido <?= $nombreBien ?> - Rol <?= $rolBien ?> aceptado.
    <?php endif; ?>
</body>
</html>