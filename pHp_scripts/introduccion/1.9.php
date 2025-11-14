<!--Ejercicio 9: Crea una variable que almacene la edad de una persona y otra que almacene si tiene
permiso de conducir. Usa un operador lógico para mostrar si puede conducir (debe tener más de
18 años y tener permiso de conducir).-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $edad = $_GET["edad"];
        $permiso = $_GET["permiso"];
        echo "La edad es $edad y el permiso es $permiso.<br/>";

        $mayor = $edad > 18?true:false;
        $conducir = $mayor == true && $permiso == "si";
        $texto = $conducir?"Puedes conducir":"No puedes conducir";
        echo $texto;
    ?>
</body>
</html>