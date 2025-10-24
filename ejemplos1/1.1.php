<!--Ejercicio 1: Define una constante con el valor de la gravedad terrestre (9.8). Luego, crea una
variable que almacene la masa de un objeto y calcula su peso multiplicando la masa por la
constante de gravedad. Muestra el resultado.-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        const GRAVEDAD = 9.8;
        $masa = $_GET['masa'];

        $peso = $masa * GRAVEDAD;

        echo "<p> La Masa del objeto es $masa</p>";
        echo "<p> El Peso del objeto es $peso</p>";

    ?>
</body>
</html>