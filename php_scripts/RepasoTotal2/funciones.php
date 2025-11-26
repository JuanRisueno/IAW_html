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
};

function calcular_coste_total($tipo_tropa, $cantidad, array $equipamientos, $prioridad){
    if($tipo_tropa === 'grunts'){
        $costeTropa = 10;
    }elseif ($tipo_tropa === 'incursores'){
        $costeTropa = 20;
    }else{
        $costeTropa = 50;
    }
    $costeTropaTotal = $costeTropa * $cantidad;

    $equipamientoArmaduras = 0;
    $equipamientoArmas = 0;
    $equipamientoJoyeria = 0;
    foreach($equipamientos as $item){
        if($item === "armas"){
            $costeEquipoUnitario += 15;
        }elseif($item === "armaduras"){
            $costeEquipoUnitario += 5;
        }elseif($item === "joyeria"){
            $costeEquipoUnitario += 5;
        }
    }
    
    $costeTotalEquipamiento = ($equipamientoArmaduras + $equipamientoArmas + $equipamientoJoyeria) * $cantidad;

    if($prioridad === 'normal'){
        $costePrioridad = 0;
    }else{
        $costePrioridad = 50;
    }

    $costeTotal = $costeTropaTotal + $costeTotalEquipamiento + $costePrioridad;
    return $costeTotal;
};