<?php
    $personas = [
        ["nombre" => "Juan", "edad" => 34],
        ["nombre" => "Rosa", "edad" => 45],
        ["nombre" => "Antonio", "edad" => 52],
    ];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
</head>
<body>
    <h1>Personas</h1>
    <table border = "2">
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
        </tr>
        <?php
            foreach($personas as $p){
                echo "<tr>";
                    echo "<td>{$p['nombre']}</td>";
                    echo "<td>{$p['edad']}</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>