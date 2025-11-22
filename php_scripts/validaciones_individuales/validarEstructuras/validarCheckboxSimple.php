<?php
    $errores=[];
    $aceptar="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $aceptar=$_POST['aceptar'] ?? '';

        if(empty($aceptar)){
            $errores['aceptar'] = "<br>Tiene que marcar la casilla aceptando los términos del contrato";
        }

        if(empty($errores)){
            echo "Términos del contrato aceptados";
            $aceptar='';
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Checkbox Simple</title>
</head>
<body>
    <h1>Vamos a validar un Checkbox simple</h1>
    <form method="POST" action="">
        <input type="checkbox" name="aceptar" value="aceptar" <?php if($aceptar == 'aceptar') echo 'checked' ?> >
            <label for="acetar">Acepta los términos del contrato.</label>
        <?= $errores['aceptar'] ?? '' ?>

        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>