<?php
    if(isset($_SESSION['ultimo_movimiento'])){
        $tiempo_transcurrido = time() - $_SESSION['ultimo_movimiento'];
        if ($tiempo_transcurrido > 60){
            //Se ha superado el tiempo máximo permitido de inactividad
            header('Location:salir.php');
            exit;
        }else{
            $_SESSION['ultimo_movimiento'] = time();
        }
    }
?>