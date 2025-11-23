<?php
    // Configuración de seguridad de la cookie
    session_name('MordorSession'); // Nombre personalizado
    
    session_set_cookie_params(
        0,              # Tiempo de vida (0 = hasta cerrar navegador)
        "/",            # Ruta
        "localhost",    # Dominio
        false,          # Secure (false para localhost, true para HTTPS)
        true            # HttpOnly (true para que JS no la lea)
    );

    // Iniciamos la sesión con estas reglas
    session_start();
?>