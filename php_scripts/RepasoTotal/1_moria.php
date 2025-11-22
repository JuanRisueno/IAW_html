<!--Ejercicio 1 - Las Puertas de Durin
Enunciado: La Compañía del Anillo se encuentra atrapada frente a los muros de Moria. Ante ellos se alzan las majestuosas Puertas de Durin, cerradas mágicamente e imposibles de forzar. En el arco hay una inscripción antigua que dice: "Habla, amigo, y entra". Gandalf necesita tu ayuda para crear un hechizo (script) que escuche lo que él dice. Si pronuncia la palabra correcta en élfico, las puertas deben abrirse y permanecer abiertas para que todos pasen. Una vez dentro, deben poder cerrar las puertas mágicamente desde el interior para protegerse del monstruo que acecha en el lago.-->

<?php
    session_start();
    require_once '0_funciones.php';

    $errores=[];
    $palabrasMagicas='';

    //Cerrar la sesión
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar'])){
        session_destroy(); //Cerramos la sesión
        header("Location: 1_moria.php"); //Recargamos la página
        exit;
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Pasamos las palabras mágicas a la función sanear
        $palabrasMagicas= sanear($_POST['palabrasMagicas'] ?? '');

        //Validamos la palabra correcta pasando palabrasMagicas
        if(esLaPalabraCorrecta($palabrasMagicas)){
            $_SESSION['acceso_moria'] = true;
        } else {
            $errores['moria'] = "<br>La puerta permanece cerrada. No es la palabra correcta.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puertas de Moria</title>
</head>
<body>
    <h1>Puertas de Moria</h1>

    <?php if(isset($_SESSION['acceso_moria'])): ?>
        
        <h2>¡Mellon! Las puertas se han abierto.</h2>
        <p>Bienvenidos a Khazad-dûm, Compañía del Anillo.</p>
        
        <form method="POST" action="">
            <input type="submit" name="cerrar" value="Cerrar Puertas">
        </form>
    
    <?php else: ?>

        <h2>Habla, amigo, y entra</h2>

        <form method="POST" action="">
            <label for="palabrasMagicas">Inscripción:</label>
            <input type="text" name="palabrasMagicas" id="palabrasMagicas" 
                    value="<?php echo htmlspecialchars($palabrasMagicas); ?>" 
                    placeholder="Dila en élfico...">
                    
            <p style="color:red"><?php echo $errores['moria'] ?? ''; ?></p>
            
            <p><input type="submit" value="Pronunciar"></p>
        </form>
    <?php endif; ?>
</body>
</html>