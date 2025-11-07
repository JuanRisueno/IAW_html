<?php
    require_once 'iniciar_sesion.php';
    $_SESSION = [];
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time () - 50000, #Tiempo actual -50000 segundos
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly'],
        );
    };

    session_destroy();
    header("Location:login.php")
?>