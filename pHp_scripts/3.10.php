<?php
    $palabras = ["rosa","amarillo","rosa","blanco","rosa","blanco"]; # Array indexado
    //$frecuencia = ["rosa" => 3, "amarillo" => 1, "blanco" => 2]; # Array asociativo 
    //Vamos a contabilizar las veces que aparece una palabra en el array indexado

    $frecuencia = [];

    foreach($palabras as $color) {
        if (array_key_exists($color, $frecuencia)){ //ya existe en el array
            $frecuencia[$color] = $frecuencia[$color] + 1;
        }else{
            $frecuencia[$color] = 1; //Se añade al array la primera vez que aparece
        }
    }

    //print_r($frecuencia); // mostrar plan fullero
    //echo "<br/>";
    var_dump(($frecuencia))
?>