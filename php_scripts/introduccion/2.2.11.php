<?php
    $palabras = ["rosa","amarillo","rosa","blanco","rosa","blanco"]; # Array indexado

    $frecuencia = [];

    foreach($palabras as $color) {
        if (array_key_exists($color, $frecuencia)){ //ya existe en el array
            $frecuencia[$color] = $frecuencia[$color] + 1;
        }else{
            $frecuencia[$color] = 1; //Se añade al array la primera vez que aparece
        }
    }

    var_dump(($frecuencia))
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.11 - Frecuencia de colores</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Color</th>
            <th>Frecuencia</th>
        </tr>
        <?php
            foreach($frecuencia as $key => $valor){
                echo "<tr>";
                    echo "<td>$key</td>";
                    echo "<td>$valor</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <hr>
    <table border="1">
        <tr>
            <th>Color</th>
            <th>Frecuencia</th>
        </tr>
        <?php
            foreach($frecuencia as $key => $valor):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$valor?></td>
            </tr>
            <?php endforeach?>
    </table>
</body>
</html>