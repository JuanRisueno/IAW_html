<?php
// 1. Iniciar el manejo de sesiones para poder destruirla
session_start();

// 2. Eliminar todas las variables de sesión
session_unset();

// 3. Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: Esto es opcional pero recomendado para una limpieza total.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Finalmente, destruir la sesión.
session_destroy();

// 5. Redirigir al formulario de login
header("Location: index.php");
exit;
?>