<!--Misión 2: Acceso Seguro a la Batcueva
🎯 Objetivo:
Gestionar un estado de "autenticado" para proteger una página secreta.
🦇 Escenario:
No cualquiera puede entrar en la Batcueva. Solo Batman (o Alfred) tiene acceso. Debes crear el
sistema de login de la Bat-computadora.
Misión:📝
Crea un sistema de tres páginas:
1. login.php: Un formulario HTML que pida "Identidad" y "Contraseña Secreta".
◦ La identidad correcta será Batman o Alfred y la contraseña caballeroOscuro (No
necesitas una BD, puedes "hardcodear" (fijar) en el código).
◦ Si el login es correcto, debe guardar en la sesión que el usuario está autenticado
guardando su nombre y redirigirlo a batcueva.php.
2. batcueva.php: ¡Esta página es el centro de mando!
◦ Al principio del script, debe comprobar si el usuario está autenticado (ej. si existe
$_SESSION['logueado'] con el usuario logueado).
◦ Si no lo está, debe expulsarlo inmediatamente, redirigiéndolo a login.php.
◦ Si sí lo está, le dará la bienvenida: "Bienvenido, [Usuario]. Archivos de la Liga de la
Justicia cargados." y le mostrará un enlace a pistas.php y a salir.php.
3. salir.php: Cierra la sesión.
◦ Debe destruir la sesión (¡con el método robusto de 3 pasos que vimos!) y redirigir al
usuario de vuelta a login.php con un mensaje de "Conexión cerrada".
4. pistas.php
◦ Añade la lógica necesaria para que si el usuario no está logueado, lo redirija al
login.php-->

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        // Imaginamos que hacemos una consulta a la BBDD
        if (($user == "Batman" || $user == "Alfred") && $pass == "1234") {
            //Login Correcto
            //Crear la sesión
            session_start();
            $_SESSION['user'] = $user;
            header("Location:5.2.2.php");

        }else{
            //Login Incorrecto
            echo "<p>Login Incorrecto.</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5.2</title>
</head>
<body>
    <h1>Acceso a la Batcueva</h1>
    <form action="" method="post">
        <label for="user">
            Usuario 
            <input type="text" name="user" id="user" placeholder="Usuario"/>
        </label>
        <label for="pass">
            <p>Contraseña 
            <input type="text" name="pass" id="pass" placeholder="Contraseña"/></p>
        </label>
        <p><input type="submit" value="Entrar"/></p>
    </form>
</body>
</html>