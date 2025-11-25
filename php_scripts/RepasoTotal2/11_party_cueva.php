<?php

$roster = [
    "orco01" => [
        "nombre" => "Thrall",
        "clase" => "Chamán",
        "rol" => "dpsMelee",
        "nivel" => 80,
        "consumibles" => [
            "comida" => [
                "plato" => "carne",
                "bebida" => "grog"
            ],
            "piedra de brujo" => true,
            "frasco" => "agilidad"
        ]
    ],
    "troll01" => [
        "nombre" => "Vol'jin",
        "clase" => "Cazador",
        "rol" => "dpsRango",
        "nivel" => 80,
        "consumibles" => [
            "comida" => [
                "plato" => "pescado",
                "bebida" => "agua"
            ],
            "piedra de brujo" => false,
            "frasco" => "agilidad"
        ]
    ],
    "undead01" => [
        "nombre" => "Sylvanas",
        "clase" => "Cazador",
        "rol" => "dpsRango",
        "nivel" => 80,
        "consumibles" => [
            "comida" => [
                "plato" => "restos",
                "bebida" => "nada"
            ],
            "piedra de brujo" => true,
            "frasco" => "agilidad"
        ]
    ],
    "orco02" => [
        "nombre" => "Colmillosauro",
        "clase" => "Guerrero",
        "rol" => "tank",
        "nivel" => 80,
        "consumibles" => [
            "comida" => [
                "plato" => "jabali",
                "bebida" => "grog"
            ],
            "piedra de brujo" => true,
            "frasco" => "fuerza"
        ]
    ],
    "tauren01" => [
        "nombre" => "Baine",
        "clase" => "Chaman",
        "rol" => "heal",
        "nivel" => 80,
        "consumibles" => [
            "comida" => [
                "plato" => "frutos",
                "bebida" => "cerveza"
            ],
            "piedra de brujo" => true,
            "frasco" => "espiritu"
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cueva de los Lamentos</title>
</head>
<body>
    <h1>Equipo para asaltar la Cueva de los Lamentos</h1>
    <h2>¡¡¡Este es nuestro equipo TOP!!!</h2>

    <ul>
    <?php foreach($roster as $personaje): ?>
        <li>Personaje:
            <ul>
                <?php if($personaje['rol'] == 'tank'): ?>
                    <li>Nombre: <strong>🛡️<?= htmlspecialchars($personaje['nombre']) ?></strong></li>
                <?php elseif($personaje['rol'] == 'heal'): ?>
                    <li>Nombre: <i>💚<?= htmlspecialchars($personaje['nombre']) ?></i></li>
                <?php elseif(($personaje['rol'] == 'dpsRango') || ($personaje['rol'] == 'dpsMelee')): ?>
                    <li>Nombre: ⚔️<?= htmlspecialchars($personaje['nombre']) ?></li>
                <?php endif; ?>
                
                <li>Clase: <?= htmlspecialchars($personaje['clase']) ?></li>
                <li>Rol: <?= htmlspecialchars($personaje['rol']) ?></li>
                <li>Nivel: <?= $personaje['nivel'] ?></li>
                
                <li>Consumibles:
                    <ul>
                        <?php foreach($personaje['consumibles'] as $item => $valor): ?>
                            <li>
                                <?= htmlspecialchars($item) ?>: 
                                <?php 
                                    if ($valor === true) {
                                        echo "Sí";
                                    } elseif ($valor === false) {
                                        echo "No";
                                    } elseif (is_array($valor)) {
                                        // NUEVA LÓGICA: Si es un array (como la comida), lo recorremos
                                        echo "<ul>";
                                        foreach($valor as $subItem => $subValor) {
                                            echo "<li>" . htmlspecialchars($subItem) . ": " . htmlspecialchars($subValor) . "</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo htmlspecialchars($valor);
                                    }
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </li>
        <hr> 
    <?php endforeach; ?>
    </ul>

</body>
</html>