<?php

//Función Sanear Texto
function sanear($texto){
    $textoLimpio=trim($texto);
    $textoSeguro= htmlspecialchars($textoLimpio);

    return $textoSeguro;
}

//Función Validar un texto
function esLaPalabraCorrecta($texto){
    if($texto == 'mellon'){
        return true;
    }else{
        return false;
    }
}

//Función Existe en un Array
function existe($nombre,$lista){
    if(in_array($nombre,$lista)){
        return true;
    }else{
        return false;
    }
    /*versión corta:
    return in_array($nombre,$lista);
    */
}
?>