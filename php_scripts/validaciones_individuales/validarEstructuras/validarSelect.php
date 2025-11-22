<?php
    $errores=[];
    $nivelIngles="";
    $opcionesValidas = ["A1","A2","B1"];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nivelIngles=$_POST['nivelIngles'] ?? '';

        if(empty($nivelIngles)){
            $errores['nivelIngles'] = "Tienes que rellenar una de las opciones.";
        }elseif (!in_array($nivelIngles,$opcionesValidas)){ //Con este array comparamos el valor elegido con los valores válidos para evitar ataques cambiando el html directamente. Lo negamos para que dé el error
            $errores['nivelIngles'] = "Opción elegida no válida";
        }

        if(empty($errores)){
            echo "Nivel de Ingles: $nivelIngles";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Select</title>
</head>
<body>
    <h1>Validación de Select</h1>
    <h2>Nivel de inglés</h2>
    <form method="POST" action="">
        
        <select id="nivelIngles" name="nivelIngles">
            <option value="">Seleccione una opción</option>
            <option value="A1" <?php if($nivelIngles == "A1") echo "Selected"; ?>>A1</option>
            <option value="A2" <?php if($nivelIngles == "A2") echo "Selected"; ?>>A2</option>
            <option value="B1" <?php if($nivelIngles == "B1") echo "Selected"; ?>>B1</option>
        </select>
        
        <?= $errores['nivelIngles'] ?? '' ?> <!--Importante FUERA DEL SELECT-->

        <input type="submit" value="Enviar">
    </form>
</body>
</html>