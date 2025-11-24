<?php 
    $errores=[];
    $estado="";
    $estados=['soltero','casado','otro'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $estado=$_POST['estado'] ?? '';

        if(empty($estado)){
            $errores['estado'] = "<br>Tienes que rellenar al menos un estado.";
        }elseif(!in_array($estado,$estados)){
            $errores['estado'] = "<br>Elección errónea";
        }

        if(empty($errores)){
            echo "Estado Civil: $estado";
            $estado="";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Radio</title>
</head>
<body>
    <h1>Vamos a validar la estructura del Radio</h1>
    <form method="POST" action="">
        <h2>Estado civil</h2>
        <input type="radio" name="estado" value="soltero" <?php if($estado == 'soltero') echo 'checked' ?> >
            <label for="soltero">Soltero</label>
        <input type="radio" name="estado" value='casado' <?php if($estado == 'casado') echo 'checked' ?> >
            <label for="casado">Casado</label>
        <input type="radio" name="estado" value="otro" <?php if($estado == 'otro') echo 'checked' ?> >
            <label for="otro">Otro</label>
        <?= $errores['estado'] ?? '' ?>
        
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>