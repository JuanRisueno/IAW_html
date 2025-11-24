<!--Ejercicio 2: La Mochila de la Incursión 🎒
Nombre del archivo: mochila_raid.php Dificultad: ⭐⭐ (2/5) Conceptos Clave: Arrays en formularios (checkbox[]), validación de Select, función count(), array_diff() y checkbox simple de confirmación.

Trasfondo: Inspección de Suministros
Antes de enfrentaros al Boss final, el líder de la banda (Raid Leader) necesita confirmar que todos lleváis los consumibles necesarios. No podéis ir vacíos, pero tampoco podéis ir sobrecargados porque perderíais agilidad. Además, debéis confirmar que os sabéis la estrategia.

📝 Tarea de PHP y HTML (mochila_raid.php):
I. Formulario (HTML)
El formulario debe incluir:

Nombre del Personaje: (input type="text").
Clase: (select) Desplegable obligatorio. Opciones: "Guerrero", "Cazador", "Mago", "Sacerdote".
Suministros de Combate: (input type="checkbox" múltiples). Deben tener el atributo name="objetos[]".

Opciones disponibles:
Poción de Sanación
Frasco de Resistencia
Piedra de Brujo
Vendas de Lino
Comida de Buff

Confirmación de Tácticas: (input type="checkbox" simple). Un checkbox único que diga "Me he leído la guía del boss". name="guia_leida".
Botón de envío.

II. Script (PHP)
Procesa los datos con las siguientes reglas estrictas (estilo Inma):

Nombre: Obligatorio y saneado (trim).
Clase: Obligatorio. Debe ser una de las clases válidas del array (usa in_array).
Suministros (Validación de Array):

El usuario debe marcar entre 2 y 4 objetos (inclusive). Si marca menos de 2 o más de 4, error.
Debes validar que los objetos enviados coinciden con la lista original (seguridad con array_diff o comprobando uno a uno).

Confirmación: El checkbox "guia_leida" es obligatorio. Si no está marcado, muestra error ("Debes conocer la estrategia antes de entrar").

Resultado:
Si todo es correcto: Mostrar un mensaje de éxito: "Registro completo. [Nombre] ([Clase]) está listo con [X] objetos en la mochila."

Si hay errores: Mostrar mensajes específicos por campo y mantener los datos introducidos (Sticky Form: el Select debe mantener la opción seleccionada y los Checkboxes marcados deben mantenerse marcados).
-->

<?php
    $errores = [];
    $nombre = "";
    $clase = "";
    $clases = ['guerrero','cazador','mago','sacerdote'];
    $suministro = [];
    $suministros = ['pocion','frasco','piedra','vendas','comida'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre'] ?? '');
        $clase = $_POST['clase'] ?? '';
        $suministro = $_POST['suministro'] ?? [];

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que rellenar tu nombre.";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($clase)){
            $errores['clase'] = "Error: Tienes que elegir tu clase.";
        }elseif(!in_array($clase,$clases)){
            $errores['clase'] = "Error: Tienes que elegir una de las clases propuestas.";
        }else{
            $claseBien = $clase;
        }

        if(empty($suministro)){
            $errores['suministro'] = "Error: Tienes que elegir suministros.";
        }elseif(!empty(array_diff($suministro,$suministros))){
            $errores['suministro'] = "Error: Solo puedes escoger entre los suministros que te damos.";
        }elseif((count($suministro) < 2) || (count($suministro) > 4)){
            $errores['suministro'] = "Error: Solo puedes escoger entre 2 y 4 suministros";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mochila de Raid</title>
</head>
<body>
    <h1>Mochila de Raid</h1>
    <h2>¡Qué no se te olvide nada!</h2>

    <form action="" method="POST">
        <label for="nombre">
            Nombre del Personaje 
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del Personaje" value="<?= htmlspecialchars($nombre ?? '') ?>">
        </label>
        <p><?= $errores['nombre'] ?? '' ?></p>
        <p>Clase</p>
        <select name="clase" id="clase">
            <option value="">Elige tu clase</option>
            <option value="guerrero" <?php if($clase == 'guerrero') echo 'selected'?> >Guerrero</option>
            <option value="cazador" <?php if($clase == 'cazador') echo 'selected'?> >Cazador</option>
            <option value="mago" <?php if($clase == 'mago') echo 'selected'?> >Mago</option>
            <option value="sacerdote" <?php if($clase == 'sacerdote') echo 'selected'?> >Sacerdote</option>
        </select>
        <p><?= $errores['clase'] ?? '' ?></p>
        <p>Suministros de combate</p>
        <label for="pocion"><input type="checkbox" name="suministro[]" id="pocion" value="pocion" <?php if(in_array('pocion',$suministro)) echo 'checked'?> >Pocion de Sanacion</label>
        <label for="frasco"><input type="checkbox" name="suministro[]" id="frasco" value="frasco"<?php if(in_array('frasco',$suministro)) echo 'checked'?> >Frasco de Resistencia</label>
        <label for="piedra"><input type="checkbox" name="suministro[]" id="piedra" value="piedra" <?php if(in_array('piedra',$suministro)) echo 'checked'?> >Piedra de Brujo</label>
        <label for="vendas"><input type="checkbox" name="suministro[]" id="vendas" value="vendas" <?php if(in_array('vendas',$suministro)) echo 'checked'?> >Vendas de Lino</label>
        <label for="comida"><input type="checkbox" name="suministro[]" id="comida" value="comida" <?php if(in_array('comida',$suministro)) echo 'checked'?> >Comida de Buff</label>
        <p><?= $errores['suministro'] ?? '' ?></p>

        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>

    <?php if(($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($errores))): ?>
        El personaje <?= $nombreBien ?> con la clase <?= $claseBien ?> Está preparado para Raid.
        <p>Se lleva los siguientes suministros: </p>
        <?php foreach ($suministro as $s): ?>
            <ul>
                <li><?= $s ?></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>