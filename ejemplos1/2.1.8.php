<!--Ejercicio 8. Tabla de Multiplicar
Escribir un script que, dado un número (por ejemplo, el 7), muestre su tabla de multiplicar del 1 al 10.-->

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $tabla = $_POST['tabla'];
        
        for($i=0;$i<=10;$i++){
            $resultado .= "$tabla x $i = ".$tabla * $i." <br>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2.8</title>
</head>
<body>
    <h1>Tablas de multiplicar</h1>
    <form action="" method="post">
        <label for="tabla">
            Introduce el número de la tabla que quieres mostrar
            <input type="text" name="tabla" id=""/>
        </label>
        <br/>
        <br/>
        <input type="submit" value="Enviar">
    </form>
    <br/>
    <?php if(isset($resultado)) echo $resultado ?>
</body>
</html>