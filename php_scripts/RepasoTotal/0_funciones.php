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

//Función Calcular Suministros orcos
function calcularSuministros($orcos,$dias){
    $comidaOrcos = $orcos * 3;
    $totalComida = $comidaOrcos * $dias;
    
    return $totalComida;
}

// Función para calcular el coste de la Clínica
function calcularCoste($tratamientosElegidos) {
    
    // 1. Definimos el "Menú de Precios" (Diccionario)
    $precios = [
        'pocion' => 10,
        'afilado' => 20,
        'cirugia' => 50
    ];

    $total = 0;

    // 2. Recorremos lo que ha elegido el usuario
    foreach ($tratamientosElegidos as $item) {
        // Si lo que ha elegido existe en nuestro menú de precios...
        if (isset($precios[$item])) {
            // ... sumamos el precio correspondiente al total
            $total += $precios[$item];
        }
    }

    return $total;
}

?>