<!--Ejercicio 2: Registro de Usuario (Checkbox Simple)
Formulario (HTML):
• Un campo input type="text" para email.
• Un input type="checkbox" con name="privacidad" y value="acepta".
• Un botón de envío.
Script (PHP):
Debe verificar si el checkbox privacidad fue marcado (usando isset()).
• Si fue marcado, debe mostrar: "Email [Email] registrado. Gracias por aceptar nuestra
política de privacidad."
• Si NO fue marcado, debe mostrar: "Error: Debe aceptar la política de privacidad para
registrarse."-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4.2</title>
</head>
<body>
    <h1>Ejercicio 4.2</h1>
    <h2>Registros de Usuarios</h2>
    <form method="post" action="">
        e-mail <input type="text" name="email"/>
        <br/>
        <label for="privacidad">
            Privacidad: <input type="checkbox" name="privacidad" value="acepta"/>
        </label>
        <p><input type="submit" name="enviar"/>    
    </form>
    <?php
        $email = $_POST['email'];
        if(isset($_POST['enviar'])){
            if(empty($email)){
                echo "<p>Error: Tienes que rellenar el campo email</p>";
            }else{
                if(isset($_POST['privacidad'])){
                    echo "<p>Email $email registrado. Gracias por aceptar nuestra política de privacidad";
                }else{
                    echo "<p>Error: Debe acepta la política de privacidad para registrarse.";
                }
            }
        }
    ?>
</body>
</html>