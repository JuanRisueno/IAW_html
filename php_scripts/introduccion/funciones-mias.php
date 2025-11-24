<!--Crea una función suma que reciba dos números y devuelva su suma. Utiliza la función en un
script que reciba dos números y muestre el resultado.-->
<?php
/*Ejercicio 1. Crea una función suma que reciba dos números y devuelva su suma.Utiliza la función en un script que reciba dos números y muestre el resultado
*/
function sumar(int $n1, int $n2): int{
    return $n1 + $n2;
}

/*
Ejercicio 2. Crea una función areaCirculo que reciba el radio de un círculo y calcule el área.
*/
function areaCirculo(float $radio): float{
    $area = (pi() * ($radio * $radio));
    return $area;
}

/*Crea una función mayorDeTres que reciba tres números y devuelva el mayor de ellos.*/
function mayorDeTres(int $n1, int $n2, int $n3): int{
    $mayor = 0;
    return $mayor;
}
?>