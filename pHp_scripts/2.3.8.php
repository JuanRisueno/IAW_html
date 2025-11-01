<!--Crea una función ordenar que reciba una lista de números y los devuelva ordenados. Ver
ordenación de arrays.-->

<?php
    require_once 'funciones.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $numCadena = $_POST['numeros'];
        $resultado = ordenar($numCadena);
                
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Relación 3 - Funciones</h1>
    <h2>Ejercicio 8 - Ordenando</h2>
    <form action="" method="post">
        <label for="numeros">
            Números:
            <input type="text" name="numeros" id="numeros"/>
        </label>
        <input type="submit" value="Ordenar">
    </form>

    <p>
        <?php 
        
        if(isset($resultado)){
            foreach($resultado as $elemento){
                echo "$elemento ";
            }
        }  
    ?>
    
</p>
</body>
</html>