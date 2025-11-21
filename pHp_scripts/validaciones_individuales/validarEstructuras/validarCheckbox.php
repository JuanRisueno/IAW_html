<?php
    $errores=[];
    $juegos=[];
    $juegosValidos=["fifa","gta","cod",'minecraft','fornite'];

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $juegos=$_POST['juegos'] ?? [];

        if(empty($juegos)){
            $errores['juegos'] = "Tienes que elegir de 1 a 3 juegos.";
        }elseif(count($juegos) > 3){
            $errores['juegos'] = "Máximo puedes elegir 3 juegos.";
        }elseif(!empty(array_diff($juegos,$juegosValidos))){
            $errores['juegos'] = "Hay un valor no válido.";
        }

        if(empty($errores)){
            foreach($juegos as $j){
                echo "Juego favorito: $j <br>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Checkbox</title>
</head>
<body>
    <h1>Vamos a validar CHECKBOX</h1>
    <form method="POST" action="">
        <h2>Elige tus juegos favoritos.</h2>
        <br>
        <!--Es importante que el name sea un nombre seguido de un array como juegos[]-->
        <input type="checkbox" name="juegos[]" id="fifa" value="fifa" <?php if(in_array('fifa',$juegos)) echo 'checked'?> >
            <label for="fifa">Fifa</label>
        <br>
        <input type="checkbox" name="juegos[]" id="cod" value="cod" <?php if(in_array('cod',$juegos)) echo 'checked'?> >
            <label for="cod">COD</label>
        <br>
        <input type="checkbox" name="juegos[]" id="gta" value="gta" <?php if(in_array('gta',$juegos)) echo 'checked'?> >
            <label for="gta">GTA</label>
        <br>
        <input type="checkbox" name="juegos[]" id="minecraft" value="minecraft" <?php if(in_array('minecraft',$juegos)) echo 'checked'?> >
            <label for="minecraft">Minecraft</label>
        <br>
        <input type="checkbox" name="juegos[]" id="fornite" value="fornite" <?php if(in_array('fornite',$juegos)) echo 'checked'?> >
            <label for="fornite">Fornite</label>
        <br>
        <?= $errores['juegos'] ?? '' ?>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>