<!--Crea una función intercambioReferencia que reciba dos números por referencia y los
intercambie. Luego, muestra los valores antes y después de llamar a la función. Prueba a
pasarlos ahora por valor y vuelve a ejecutar el script. ¿Qué sucede?-->

<?php
    require_once 'funciones.php';
    
    //Inicializao las variables n1 y n2 a un valor vacio
    //Es otra forma de que no salga el warning en el value de los input del formulario
    //cuando no hemos enviado el formulario y no existe $n1 ni $n2
    $n1=''; 
    $n2='';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $n1 = $_POST['num1'];
        $n2 = $_POST['num2'];
        intercambiar($n1, $n2);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intercambio</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 12 - Intercambiar valores</h2>
    <form action="" method="post">
        <label for="num1">
            Número 1: 
            <input type="text" name="num1" id="num1" value="<?=$n1?>"/>
        </label>
        <label for="mes">
            Número 2: 
            <input type="text" name="num2" id="num2" value="<?=$n2?>"/>
        </label>
        <input type="submit" value="Intercambiar">
    </form>

</body>
</html>