<!--Ejercicio 1: Encuesta de Satisfacción (Radio Buttons)
Formulario (HTML):
• Un campo input type="text" para el nombre.
• Un grupo de 3 input type="radio" con name="satisfaccion" y values "bueno", "regular",
"malo".
• Un botón de envío.
Script (PHP):
• Debe verificar si se envió el formulario.
• Debe verificar si se seleccionó una opción de satisfacción usando isset().
• Si se seleccionó, debe mostrar: "Hola [Nombre], gracias por tu valoración: [Satisfacción]".
• Si no se seleccionó, debe mostrar: "Hola [Nombre], por favor, elige un nivel de
satisfacción."-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4.1</title>
</head>
<body>
    <h1>Ejercicio 4.1</h1>    
    <h2>Valoración de Satisfacción</h2>
    <form action="" method="post">
        <p>Nombre
        <input type="text" name="nombre"/></p>
        <p>Satisfacción</p>
        <label for="Bueno">
            Bueno: <input type="radio" name="satisfaccion" id="bueno" value="bueno"/>
        </label>
        <label for="Regular">
            Regular: <input type="radio" name="satisfaccion" id="regular" value="regular"/>
        </label>
        <label for="Malo">
            Malo: <input type="radio" name="satisfaccion" id="malo" value="malo"/>
        </label>
        <p><input type="submit" name="enviar"/></p>
    </form>

    <?php
        $nombre = $_POST['nombre'];
        if(isset($_POST['enviar'])){
            if(isset($_POST['satisfaccion'])){
                $val = $_POST['satisfaccion'];
                echo "<p>Hola $nombre, gracias por tu valoración: $val</p>";
            }else{
                echo "<p>Hola $nombre. Por favor elige un nivel de satisafacción</p>";
            }
        }
    ?>
</body>
</html>