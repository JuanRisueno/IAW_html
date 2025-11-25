<?php
function calcular_salario_esperado($experiencia, $especialidad){
    $oroBase=1000;
    $oroEspecialidad=0;
    $oroExperiencia=0;
    $oroExperiencia= $experiencia * 100;

    if ($especialidad == 'explosivos'){
        $oroEspecialidad = 500;
    }elseif ($especialidad == 'alquimia'){
        $oroEspecialidad = 200;
    } else {
        $oroEspecialidad = 0;
    }

    $salario = $oroBase + $oroExperiencia + $oroEspecialidad;

    return $salario;
}