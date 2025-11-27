<?php
function calcularInscripcion($reino, $peso, $montura, $armas, $edad) {
    // 1. Coste Base por Reino
    $costeTotal = 0;
    if ($reino == 'ventormenta') {
        $costeTotal = 100;
    } elseif ($reino == 'lordaeron') {
        $costeTotal = 80;
    } elseif ($reino == 'gilneas') {
        $costeTotal = 90;
    }

    // 2. Sobrecarga de Armadura (>30kg)
    if ($peso > 30) {
        $sobrepeso = $peso - 30;
        $costeTotal += ($sobrepeso * 1); // 1 moneda por cada Kg extra
    }

    // 3. Suplemento de Armas (Array)
    // Usamos in_array para sumar si existen
    if (in_array('espada', $armas)) {
        $costeTotal += 10;
    }
    if (in_array('lanza', $armas)) {
        $costeTotal += 15;
    }
    if (in_array('maza', $armas)) {
        $costeTotal += 10;
    }

    // 4. Multiplicador de Montura (Grifo x2)
    // Importante: Multiplica todo lo acumulado hasta ahora
    if ($montura == 'grifo') {
        $costeTotal *= 2;
    }

    // 5. Descuento por Edad (Novato < 20 años)
    if ($edad < 20) {
        $costeTotal -= 20;
    }

    // Aseguramos que no salga precio negativo (opcional pero buena práctica)
    return max(0, $costeTotal);
}
