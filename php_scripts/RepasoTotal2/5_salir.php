<!--3. Archivo 5_salir.php
PHP:

Este script no tiene HTML visual.

Su única función es destruir la sesión actual por completo.

Una vez destruida, debe redirigir al usuario automáticamente a la portada (3_login.php).
-->

<?php
    session_name('guarida');
    session_start();

    // 1. Vaciar array
    $_SESSION = [];

    // 2. Borrar cookie de sesión (Buenas prácticas estándar)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // 3. Destruir
    session_destroy();

    // 4. Redirigir
    header('Location: 3_login.php');
    exit;
?>