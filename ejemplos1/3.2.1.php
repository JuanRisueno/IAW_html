<?php
$array = [1,6,3,8,3,9];
$minimo = 9;
$maximo = 0;

//Procesar el array
foreach($array as $n){
    if ($minimo > $n){
        $minimo = $n;
    }
    if ($maximo < $n){
        $maximo =$n;
    }
}

//Salida
echo "Mínimo: $minimo. Máximo: $maximo";
?>