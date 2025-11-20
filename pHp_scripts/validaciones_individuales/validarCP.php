<?php
    $cp="";
    $errores=[];

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $cp=trim($_POST['cp']);

        if(empty($cp)){
            $errores['cp'] = "Tienes que rellenar el campo Código Postal";
        }elseif (!preg_match("/^\d{5}$/",$cp)){
            $errores['cp'] = "El CP debe tener exactamente 5 dígitos";
        }

        if(empty($errores)){
            echo "Formulario mandado con éxito";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de un Código Postal</title>
</head>
<body>
    <h1>Vamos a validar un Código Postal</h1>
    <form method="POST" action="">
        Código Postal: 
        <input type="text" name="cp" value="<?php echo htmlspecialchars($cp) ?? '' ?>">
        <?php echo $errores['cp'] ?? '' ?>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>