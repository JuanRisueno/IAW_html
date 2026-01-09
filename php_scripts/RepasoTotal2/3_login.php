<!--1. Archivo 3_login.php
HTML: Crea un formulario con dos campos: Usuario y Contraseña.

PHP:

Recoge los datos.

Comprueba si el usuario es "Alexstrasza" y la contraseña es "fuego".

Si es correcto: Inicia la sesión, guarda el nombre en una variable de sesión ($_SESSION) y redirige al usuario automáticamente a 4_camara.php.

Si es incorrecto: Muestra un mensaje de error en rojo: "¡No eres bienvenido aquí!".
-->

<?php
    session_name('guarida');
    session_start();
    $errores = [];
    $nombre = '';
    $pass = '';
    $error_login = ''; // Variable local para error de credenciales

    // Si ya está logueado, lo mandamos directo adentro (opcional pero recomendado)
    if(isset($_SESSION['guarida']) && $_SESSION['guarida'] === true){
        header('Location: 4_camara.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre'] ?? '');
        // La contraseña NO se trimea ni sanea (puede contener espacios a propósito)
        $pass = $_POST['pass'] ?? ''; 

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que introducir un nombre";
        }

        if(empty($pass)){
            $errores['pass'] = "Error: Tienes que introducir una contraseña";
        }

        if(empty($errores)){
            if($nombre == "Alexstrasza" && $pass == "fuego"){
                $_SESSION['guarida'] = true; // Login correcto
                $_SESSION['usuario'] = $nombre; // Guardamos el nombre
                header('Location: 4_camara.php');
                exit;
            }else{
                $error_login = "No eres Alexstrasza. No puedes entrar.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada</title>
</head>
<body>
    <h1>Hogar de Alexstrasza</h1>
    <form action="" method="POST">
        <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>"></label>
        <?= $errores['nombre'] ?? '' ?>
        <br><br>
        <label>Pass: <input type="password" name="pass"></label>
        <?= $errores['pass'] ?? '' ?>
        <br>
        <p><input type="submit" value="Enviar"></p>
    </form>
    
    <p style="color:red;"><?= $error_login ?></p>
</body>
</html>