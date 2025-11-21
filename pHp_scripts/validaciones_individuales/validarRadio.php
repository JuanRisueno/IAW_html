<?php
    $errores=[];
    $nivel="";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Radio</title>
</head>
<body>
    <h1>Validación de Radio</h1>
    <h2>Nivel de inglés</h2>
    <form method="POST" action="">
        <p>Nivel de inglés.</p>
        <input type="radio" name="nivel" id="A1"><label for="A1">Nivel A1</label>
        <input type="radio" name="nivel" id="A2"><label for="A2">Nivel A2</label>
        <input type="radio" name="nivel" id="A3"><label for="A3">Nivel A3</label>
        <br/>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>