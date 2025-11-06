<!--Misión 1: El Contador de Pistas del Enigma
🎯 Objetivo:
Entender el ciclo de vida básico: session_start(), leer, modificar y guardar una variable de sesión.
🦇 Escenario:
Eres Batman. Estás en la escena del crimen y El Enigma (Riddler) ha dejado un rastro de pistas.
Tu Bat-computadora portátil (esta página web) debe recordar cuántas pistas has encontrado.
Misión:📝
Crea un único archivo (pistas.php). Esta página debe contener un enlace que recargue la página
y debe mostrar al usuario cuántas "pistas" ha encontrado (cuántas veces ha recargado la
página):
    • La primera vez que entra, debe decir: "Bienvenido, Detective. Has encontrado tu
primera pista."
    • Las veces siguientes, debe decir: "Sigues investigando. Has encontrado [X] pistas."
💡 Pista de Alfred:
    • Inicia la sesión (session_start()).
    • Comprueba si $_SESSION['pistas'] existe con isset().
    • Si no existe, créala con el valor 1.
    • Si existe, ¡increméntala!
    • Muestra el mensaje apropiado.
🔑 Conceptos Clave: session_start(), isset(), leer/escribir en $_SESSION.-->

<?php
    session_start();

    if(isset($_SESSION['num_pistas'])){
        $_SESSION['num_pistas'] += 1;
    }else{
        $_SESSION['num_pistas'] = 1;
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5.1</title>
</head>
<body>
    <h1>Ejercicio 5.1</h1>
    <h2>Búsqueda de pistas</h2>
    <h3>Hola Batman</h3>
    <?php if($_SESSION['num_pistas'] == 1){
        echo "<p>Has encontrado tu primera pista</p>";
    }else{
        echo "<p>Sigues investigando, has encontrado {$_SESSION['num_pistas']} pistas</p>";
    }
    ?>
    <p><a href="5.1.php">Encontrar Pistas</a></p>
    
</body>
</html>