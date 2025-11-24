<!--2. Archivo 4_camara.php (Página protegida)
PHP (Seguridad):

Lo primero que debe hacer este script es comprobar si hay alguien logueado.

Si NO hay usuario en la sesión: Expúlsalo inmediatamente redirigiendo de vuelta a 3_login.php.

Si SÍ hay usuario: Deja que cargue la página.

HTML:

Muestra un mensaje de bienvenida usando el nombre guardado en la sesión (ej: "Bienvenida, Alexstrasza").

Añade un enlace (HTML simple) que diga "Cerrar Sesión" y apunte a 5_salir.php.
-->

<?php
    session_name('guarida');
    session_start();

    // 1. Lógica de SEGURIDAD (El Guardián)
    // Si la variable de sesión no existe o no es true, fuera.
    if(empty($_SESSION['guarida']) || $_SESSION['guarida'] !== true){
        header('Location: 3_login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guarida de Alexstrasza</title>
</head>
<body>
    <h1>Guarida de Alexstrasza</h1>
    <h2>Bienvenida, <?= htmlspecialchars($_SESSION['usuario'] ?? 'Reina') ?></h2>
    
    <p>Aquí están los huevos de dragón seguros.</p>

    <form action="5_salir.php" method="POST">
        <input type="submit" value="Cerrar Sesión">
    </form>
</body>
</html>