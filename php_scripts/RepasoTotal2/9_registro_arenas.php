<?php
    $errores=[];
    $nombre="";
    $codigo="";
    $modalidad="";
    $reino="";
    $clase=[];
    $clases=['guerrero','paladin','sacerdote','picaro'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=trim($_POST['nombre'] ?? '');
        $codigo=trim($_POST['codigo'] ?? '');
        $modalidad= $_POST['modalidad'] ?? '';
        $reino = $_POST['reino'] ?? '';
        $clase = $_POST['clase'] ?? [];

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que rellenar el nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($codigo)){
            $errores['codigo'] = "Error: Tienes que rellenar el código";
        }elseif(!preg_match("/^#\d{4}$/",$codigo)){
            $errores['codigo'] = "Error: El codigo tiene que tener el formato # + 4 digitos";
        }else{
            $codigoBien = $codigo;
        }

        if(empty($modalidad)){
            $errores['modalidad'] = "Error: Tienes que elegir una modalidad";
        }else{
            $modalidadBien = $modalidad;
        }

        if(empty($reino)){
            $errores['reino'] = "Error: Tienes que elegir un reino";
        }else{
            $reinoBien = $reino;
        }

        if(empty($clase)){
            $errores['clase'] = "Error: Tienes que elegir mínimo 1 clase";
        }elseif (!empty(array_diff($clase,$clases))){
            $errores['clase'] = "Error: La clase solo puede ser una de las que te ofrecemos";
        }elseif (count($clase) > 2){
            $errores['clase'] = "Error: Puedes seleccionar máximo 2 clases";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Arenas</title>
</head>
<body>
    <h1>Registro de Arenas</h1>
    <h2>Inscribe a tu equipo</h2>

    <form action="" method="POST">
        <label for="nombre">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del equipo" value="<?= htmlspecialchars($nombre ?? '') ?>">
            <p><?= $errores['nombre'] ?? '' ?></p>
        </label>
        <label for="codigo">
            <input type="text" name="codigo" id="codigo" placeholder="Código de Registro" value="<?= htmlspecialchars($codigo ?? '') ?>">
            <p><?= $errores['codigo'] ?? '' ?></p>
        </label>
        <p>Modalidad</p>
        <p>
            <label for="2v2"><input type="radio" name="modalidad" value="2v2" id="2v2" <?php if($modalidad == '2v2') echo "checked" ?> >2v2</label>
            <label for="3v3"><input type="radio" name="modalidad" value="3v3" id="3v3" <?php if($modalidad == '3v3') echo "checked" ?> >3v3</label>
        </p>
        <p><?= $errores['modalidad'] ?? '' ?></p>

        <p>Selecciona un reino</p>
        <select name="reino" id="reino">
            <option value="">Selecciona</option>
            <option value="mandokir" <?php if($reino == 'mandokir') echo "selected" ?> >Mandokir</option>
            <option value="sanguino" <?php if($reino == 'sanguino') echo "selected" ?> >Sanguino</option>
            <option value="dunmodr" <?php if($reino == 'dunmodr') echo "selected" ?> >Dun Modr</option>
        </select>
        <p><?= $errores['reino'] ?? '' ?></p>
        <p>Clases más buscadas</p>
        <label for="guerrero"><input type="checkbox" name="clase[]" value="guerrero" id="guerrero" <?php if(in_array('guerrero',$clase)) echo 'checked' ?> >Guerrero</label>
        <label for="paladin"><input type="checkbox" name="clase[]" value="paladin" id="paladin" <?php if(in_array('paladin',$clase)) echo 'checked' ?>>Paladin</label>
        <label for="sacerdote"><input type="checkbox" name="clase[]" value="sacerdote" id="sacerdote" <?php if(in_array('sacerdote',$clase)) echo 'checked' ?>>Sacerdote</label>
        <label for="picaro"><input type="checkbox" name="clase[]" value="picaro" id="picaro" <?php if(in_array('picaro',$clase)) echo 'checked' ?>>Pícaro</label>
        <p><?= $errores['clase'] ?? '' ?></p>

        <p><input type="submit" name="enviar" id="enviar" value="Enviar"></p>
    </form>

    <?php if(($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($errores))): ?>
        <p>Nombre del participante: <?= htmlspecialchars($nombreBien) ?></p>
        <p>Código del participante: <?= htmlspecialchars($codigoBien) ?></p>
        <p>Modalidad: <?= htmlspecialchars($modalidadBien) ?></p>
        <p>Reino: <?= htmlspecialchars($reinoBien) ?></p>
        <p>Clases a las que se apunta:</p>
        <ul>
        <?php foreach($clase as $c): ?>
                <li><?= $c ?></li>
        <?php endforeach;?>
        </ul>
    <?php endif; ?>
</body>
</html>