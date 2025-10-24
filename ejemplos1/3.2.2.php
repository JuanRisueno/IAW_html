<?php
$array = [2,6,3,8,3,9];
$minimo = $array[0];
$maximo = $array[0];

//Procesar el array
/*foreach($array as $n){
    if ($minimo > $n){
        $minimo = $n;
    }
    if ($maximo < $n){
        $maximo =$n;
    }
}*/

for ($n=1;$n<count($array);$n++){
    if ($minimo > $array[$n]){
        $minimo = $array[$n];
    }
    if ($maximo < $array[$n]){
        $maximo = $array[$n];
    }
}

//Salida
echo "Mínimo: $minimo. Máximo: $maximo";
?>