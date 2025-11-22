<!--
⛏️ La Minería de Moria (1_mineria.php) Dificultad: ⭐ (Estándar Examen)
Concepto: Nivel Estándar. Acumulador simple (sumar números) con validación positiva.

Gimli y su equipo de enanos están excavando en las minas de Moria buscando Mithril. El capataz necesita llevar la cuenta del peso total extraído hasta el momento para saber cuándo han alcanzado la cuota del día. No le importa quién picó qué, solo le importa que el montón de mineral crezca.

Debes crear una herramienta web sencilla para el registro:

Entrada: Un formulario donde el enano introduce los Gramos de Mithril que acaba de extraer (número entero).
Validación: El sistema debe asegurarse de que el número es válido y positivo (no se puede extraer -10 gramos, eso sería robar).
El Montón (Acumulador): Cada vez que se envía un cargamento válido, esos gramos se suman a una variable en la sesión llamada total_mithril.
Ejemplo: Si había 100g y añaden 50g, el nuevo total es 150g.
Visualización: En la pantalla debe aparecer un mensaje grande y claro: "Total de Mithril en el almacén: [X] gramos".

Reinicio: Un botón "Entregar cargamento al Rey" que vacía el almacén (pone el contador a 0).-->
<?php 
    session_start();
    $errores=[];
    $gramos='';

    if(!isset($_SESSION['total_mithril'])){
        $_SESSION['total_mithril'] = 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reiniciar'])){
        session_destroy();
        header('Location: 1_mineria.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gramos'])){
        $gramos=filter_var($_POST['gramos'] ?? '',FILTER_SANITIZE_NUMBER_INT);

        if(empty($gramos)){
            $errores['gramos'] = "Tienes que introducir una cantidad de gramos para poder sumar.";
        }elseif (filter_var($gramos,FILTER_VALIDATE_INT) === false){
            $errores['gramos'] = "Los gramos son números enteros.";
        }elseif ($gramos <= 0){
            $errores['gramos'] = "Los gramos son siempre positivos";
        }else{
            $gramosBien=$gramos;
        }

        if(empty($errores)){
            $_SESSION['total_mithril'] += $gramosBien;
            $gramos='';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minería de Gimli</title>
</head>
<body>
    <h1>Contabilidad del Mithril</h1>
    <form action="" method="POST">
        <label for="gramos">Gramos de Mithril 
            <input type="text" name="gramos" id="gramos" placeholder="Gramos de Mithril" value="<?= htmlspecialchars($gramos) ?? ''?>" >
            <?= $errores['gramos'] ?? '' ?>
        </label>
        <p><input type="submit" value="Enviar"></p>
    </form>
    <form action="" method="POST">
        <input type="submit" name="reiniciar" value="Reiniciar">
    </form>
    <h2>Gramos total acumulados: <?php echo $_SESSION['total_mithril'] ?></h2>
</body>
</html>