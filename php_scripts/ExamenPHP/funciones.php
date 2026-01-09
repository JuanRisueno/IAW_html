<?php

function tasarCoche($base,$year,$equipo,$antigua){
    $precioTotal = 0;
    $precioBase = 0;
    $precioEquipo = 0;
    $matriAntigua = 0;
    
    if($base === 'toyota'){
        $precioBase = 10000;
    }elseif($base === 'ford'){
        $precioBase = 8000;
    }elseif($base === 'bmw'){
        $precioBase = 12000;
    }

    $yearActual = date('Y');
    $anti = $yearActual - $year;

    $precioEquipo = $equipo * 200;

    if($antigua == 1){
        $matriAntigua = -500;
    }

    $precioTotal = $precioBase + $anti + $precioEquipo + $matriAntigua;
    return $precioTotal;
}

function calcularTotalPresupuesto($productos){
    $precio = 0;
    $precioSuma = 0;

    foreach ($productos as $p){
        $precio = $p['precio'];
        $precioSuma = $precioSuma + $precio;
    }

    return $precioSuma;

}