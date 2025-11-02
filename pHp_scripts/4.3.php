<!--Ejercicio 3: Configuración de Notificaciones (Múltiples Checkboxes)
Formulario (HTML):
• Un grupo de 3 input type="checkbox" todos con name="notificaciones[]".
• Los values deben ser: "email", "telefono", "sms".
• Un botón de envío.
Script (PHP):
• Debe verificar si se marcó al menos una casilla (con isset($_POST['notificaciones'])).
• Si se marcaron, debe mostrar un mensaje "Recibirás notificaciones por:" y luego listar
todas las opciones marcadas usando un bucle foreach.
• Si no se marcó ninguna, debe mostrar: "Has desactivado todas las notificaciones."-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4.3</title>
</head>
<body>
    <h1>Ejercicio 4.3</h1>
    <h2>Configuración de Notificaciones</h2>
    <form action="" method="post">
        <p>Notificaciones</p>
        <label for="email">
            e-mail <input type="checkbox" name="notificaciones[]" value="email"/>
        </label>
        <label for="telefono">
            Teléfono <input type="checkbox" name="notificaciones[]" value="telefono"/>
        </label>
        <label for="sms">
            SMS <input type="checkbox" name="notificaciones[]" value="sms"/>
        </label>
        <p><input type="submit" name="enviar"/></p>
    </form>
    <?php
        $notificaciones = $_POST['notificaciones'];
        if(isset($_POST['enviar'])){
            if(empty($notificaciones)){
                echo "<p>Has desactivado todas las notificaciones</p>";
            }else{
                echo "<p>Vas a recibir notificaciones por: ";
                foreach($notificaciones as $notificacion){
                    echo "$notificacion ";
                }
            }
        }
    ?>
</body>
</html>