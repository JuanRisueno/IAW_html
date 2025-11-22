<!--
🐴 El Alquiler de Ponis (666_ponis.php) Dificultad: ⭐⭐⭐⭐⭐ (Nivel Jefe Final)
Concepto: Función matemática, validación de decimales/enteros y acumulador de deuda total.

Los Hobbits han conseguido llegar a la posada "El Poni Pisador" en Bree bajo una lluvia torrencial. Necesitan salir de allí rápido para escapar de los Jinetes Negros, pero sus piernas cortas no dan para más. El posadero, Cebadilla Mantecona, accede a alquilarles sus bestias, pero tiene una tarifa un tanto peculiar y quiere que tú, como mago informático, le hagas una calculadora para no equivocarse con las cuentas.

La tarifa de Cebadilla es la siguiente:

Solo por contratar el servicio (abrir el contrato), cobra una Tarifa Base de 5 monedas.

Por cada Kilómetro de viaje que planeen hacer, suma 2 monedas.

Por cada Día que tarden en devolver al animal, suma 10 monedas (porque comen mucho).

Cebadilla necesita un formulario donde introducir la Distancia (Km) y los Días de alquiler. Al calcularlo, el sistema debe decirle el precio de ese poni concreto, pero además, como seguramente alquilen varios (uno para Frodo, otro para Sam, etc.), necesita que el sistema vaya sumando el coste a una "Deuda Total" que no se borre. Y por último, un botón para "Cobrar y olvidar" (borrar la deuda) cuando los Hobbits le paguen.-->
<?php 
    session_start();
    require_once '0_funciones.php';

    if(!isset($_SESSION['historial_alquiler'])){
        $_SESSION['historial_alquiler'] = [];
    }

    $errores=[];
    $nombre='';
    $km='';
    $dias='';
    
    $costeTotal=0;
    foreach($_SESSION['historial_alquiler'] as $alquiler){
        $costeTotal += $alquiler['coste'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cobrar'])){
        session_destroy();
        header('Location: 666_ponis.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])){
        $nombre=sanear($_POST['nombre'] ?? '');
        $km=trim($_POST['km'] ?? '');
        $dias=filter_var($_POST['dias'] ?? '',FILTER_SANITIZE_NUMBER_INT);

        //Validar Nombre
        if(empty($nombre)){
            $errores['nombre'] = "<br>Tienes que introducir el nombre de un arrendatario.";
        }else{
            $nombreBien = $nombre;
        }

        //Validar km
        if(empty($km)){
            $errores['km'] = "<br>Tienes que introducir los kms.";
        }elseif (filter_var($km,FILTER_VALIDATE_FLOAT) === false){
            $errores['km'] = "<br>Los km tienen que ser un número.";
        }elseif ($km <= 0){
            $errores['km'] = "<br>Los km tienen que ser un valor mayor de 0";
        }else{
            $kmBien = $km;
        }

        //Validar días
        if(empty($dias)){
            $errores['dias'] = "<br>Tienes que introducir los días.";
        }elseif (filter_var($dias,FILTER_VALIDATE_INT) === false){
            $errores['dias'] = "<br>Los días tienen que ser un número entero.";
        }elseif ($dias <=0){
            $errores['dias'] = "<br>El poni se alquía mínimo 1 día entero";
        }else{
            $diasBien = $dias;
        }

        //Sin errores
        if(empty($errores)){
            $precioPoni = calculoPoni($kmBien,$diasBien);
            $costeTotal += $precioPoni;

            $_SESSION['historial_alquiler'][] = [
                'nombre' => $nombreBien,
                'km' => $kmBien,
                'dias' => $diasBien,
                'coste' => $precioPoni,
                'hora' => date('H:i:s')
            ];

            $nombre = $km = $dias = '';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Poni Pisador</title>
</head>
<body>
    <h1>Bienvenido al Poni Pisador</h1>
    <h2>Alquiler de animales para el transporte</h2>
    <form action="" method="POST">
        <label for="nombre">
            Nombre <input type="text" name="nombre" id="nombre" placeholder="Nombre del Arrendador" value="<?= htmlspecialchars($nombre) ?? '' ?>" >
            <?= $errores['nombre'] ?? '' ?>
        </label>
        <br>
        <label for="km">
            KM <input type="text" name="km" id="km" placeholder="KM" value="<?= htmlspecialchars($km) ?? '' ?>" >
            <?= $errores['km'] ?? '' ?>
        </label>
        <br>
        <label for="dias">
            Días <input type="text" name="dias" id="dias" placeholder="Días" value="<?= htmlspecialchars($dias) ?? '' ?>" >
            <?= $errores['dias'] ?? '' ?>
        </label>
        <p><input type="submit" value="Añadir"></p>
    </form>
    <form action="" method="POST">
        <input type="submit" name="cobrar" value="Cobrar y olvidar">
    </form>
    <h2>Historial de alquileres</h2>
    <?php if(empty($_SESSION['historial_alquiler'])): ?>
        <p>Aún no se han alquilado ponis</p>
    <?php else: ?>
        <ol>
            <?php foreach($_SESSION['historial_alquiler'] as $alquiler): ?>
                <li><?= htmlspecialchars($alquiler['nombre']) ?> alquiló un poni por <?= $alquiler['dias'] ?> días (<?= $alquiler['km'] ?> km). 
                Coste: <?= $alquiler['coste'] ?> monedas (<?= $alquiler['hora'] ?>).</li>
            <?php endforeach; ?>
        </ol>
        Precio total de los ponis:<?= htmlspecialchars($costeTotal) ?>
    <?php endif; ?>
</body>
</html>