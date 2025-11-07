<?php
    session_name ('BatSignal');
    
    session_set_cookie_params(
        0,              #Tiempo de vida
        "/",            #Disponible en todo el sitio web
        "localhost",    #Mi dominio
        false,          #En Producción hay que ponerlo en True (HTTPS)
        true            #Para que no se puede acceder a la cookie con JS
    );

    session_start();
?>