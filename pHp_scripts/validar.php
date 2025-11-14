<?php
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(filter_var($_POST['numero'], FILTER_VALIDATE_INT) === false){
            $errores['numero'] = "El valor no es un numero valido";
        }elseif ($_POST['numero'] < 1 || $_POST['numero'] > 10){
            $errores['numero'] = "El numero debe estar entre 1 y 10";   
        }else{
            $numero = $_POST['numero'];
        }

        if(empty($errores)){
            echo "Todo es Correcto ";
            echo htmlspecialchars($numero);
        }
    }    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="" method="post">
        <label for="numero">numero
            <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($numero) ?? ''; ?>" required>
        </label>
        <?php if(isset($errores['numero'])): ?>
            <p><?php echo $errores['numero']; ?></p>
        <?php endif; ?>
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>