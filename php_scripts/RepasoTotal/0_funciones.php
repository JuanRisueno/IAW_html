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

//Función Calculo 
function calculoPoni($km,$dias){
    $base = 5;
    $precioKmTotal = $km * 2;
    $precioDiasTotal = $dias * 10;

    $precioTotal = $base + $precioKmTotal + $precioDiasTotal;

    return $precioTotal;
}
?>