<?php
/*1.- Crea una función suma que reciba dos números y devuelva su suma. Utiliza la función en un script que reciba dos números y muestre el resultado.*/
function sumar(int $n1, int $n2):int{
    return $n1+$n2;
}

/*4.- Crea una función tablaMultiplicar que reciba un número y devuelva su tabla de multiplicar*/
function tabla(int $n):string
{
    $salida = "<ul>";
    for ($i=0;$i<=10;$i++){
        $salida .= "<li>$n * $i = ".($n*$i)."</li>";
    }

    $salida .= "<ul>";
    
    return $salida;
}

?>