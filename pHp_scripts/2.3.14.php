<!-- Crea una función mediaNotas que reciba un array multidimensional de alumnos y sus notas
(p.ej., [“Ana” => [7, 5, 8], “Luis” =>[3, 5, 5], “Eva” => [1, 4, 10] ]). La función debe calcular y
devolver la nota media de cada alumno y la nota media de la clase-->

<?php
require_once 'funciones.php';

$listaAlumnos = [];
$resultados = [];

if(isset($_POST["Agregar"]) || isset($_POST["Finalizar"])){
    // Recuperar lista actual desde hidden
    if(isset($_POST['lista_actual'])){
        $listaAlumnos = unserialize(base64_decode($_POST['lista_actual']));
    }
    
    $alumno = $_POST['alumno'];
    $notas = $_POST['notas'];
    
    if(isset($_POST["Agregar"]) && !empty($alumno) && !empty($notas)){
        $notasArray = explode(',', $notas);
        $notasArray = array_map('intval', $notasArray);
        $listaAlumnos[$alumno] = $notasArray;
    }
    
    if(isset($_POST["Finalizar"]) && !empty($listaAlumnos)){
        $resultados = mediaNotas($listaAlumnos);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.14</title>
</head>
<body>
    <h1>Ejercicio 3.14</h1>    
    <h2>Relación de notas del Alumno.</h2>
    <form method="post" action="">
        <label for="alumno">
            Alumno 
            <input type="text" name="alumno" id="alumno" />
        </label>
        <label for="notas">
            Notas  
            <input type="text" name="notas" id="notas" />
        </label>
        <input type="hidden" name="lista_actual" value="<?= base64_encode(serialize($listaAlumnos)) ?>">
        <input type="submit" name="Agregar" value="Agregar alumno">
        <input type="submit" name="Finalizar" value="Finalizar">
    </form>

    <?php 
        if(isset($_POST["Finalizar"]) && !empty($resultados)) {
            echo "<h3>Resultados:</h3>";
            foreach($resultados as $alumno => $media){
                echo "<p>$alumno: $media</p>";
            }
        }
    ?>
</body>
</html>