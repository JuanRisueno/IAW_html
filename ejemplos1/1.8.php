<!--Ejercicio 8: Crea una variable que almacene una nota de examen y usa un operador relacional
para mostrar si el estudiante ha aprobado o suspendido (considera que la nota mínima para
aprobar es 5).-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nota=$_GET["nota"];
        echo "La nota a evaluar es: $nota.<br/>";

        $aprobado = $nota >= 5?"Aprobado":"Suspenso";
        echo "Eso es: $aprobado"
    ?>
</body>
</html>