<!--Ejercicio 11: Gervasio y Facundina quieren ir al cine para ver una película que está restringida a
mayores de edad (18 o más años). Diseña un programa en PHP que lea las edades de Gervasio y
Facundina e indique si ambos pueden ver la película juntos, si solamente uno de ellos puede
verla o si no puede verla ninguno.-->

<!DOCTYPE html>
<html lang="e2">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $gervasio=$_GET["gervasio"];
        $facundina=$_GET["facundina"];
        echo "<p>La edad de Gervasio es: $gervasio.</p>";
        echo "<p>La edad de Facundina es: $facundina.</p>";

        $pGervasio = $gervasio >= 18?true:false;
        $siGervasio = $pGervasio?"Gervasio puede ver la película":"Gervasio no puede ver la película";
        echo "<p>$siGervasio</p>";
        $pFacundina = $facundina >= 18?true:false;
        $siFacundina = $pFacundina?"Facundina puede ver la película":"Facundina no puede ver la película";
        echo "<p>$siFacundina</p>";

        $cine = $pGervasio&&$pFacundina?"Pueden ver la película los dos juntos":"No pueden ver la pelicula juntos";

        echo $cine


    ?>
</body>
</html>