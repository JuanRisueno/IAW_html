<!--📜 Ejercicio 10 - La Clínica de Bestias de Isengard - Dificultad: ⭐⭐⭐⭐ (Difícil)

Nombre del archivo: 10_clinica.php Basado en: Ejercicio 9 (Veterinaria) del PDF 4.2.

Enunciado: Saruman está creando un ejército de Uruk-hai, pero sus bestias (Wargos) enferman a menudo. Necesita un sistema para gestionar la "Clínica de Bestias" y saber cuánto oro le cuesta curarlas.

Tu misión es crear un formulario para registrar el ingreso de una bestia:

    Paciente: Nombre de la bestia (Texto, obligatorio).
    Raza (Radio): "Orco", "Wargo" o "Troll". (Obligatorio).
    Tratamientos (Checkbox - Array): Se pueden seleccionar varios.

        Poción de Vida (10 monedas).
        Afilado de Dientes (20 monedas).
        Cirugía Oscura (50 monedas).

        (Debe validarse que lo elegido existe y que hay al menos 1 marcado).

Requisitos Técnicos:
    Función (en 0_funciones.php):
        Crea calcularCoste($tratamientos). Recibe el array de tratamientos marcados y devuelve el precio total sumando lo que cueste cada uno.
        Pista: Dentro de la función necesitarás un array con los precios: ['pocion'=>10, 'afilado'=>20...].

    Sesión:
        Acumula el Gasto Total de Saruman en una variable de sesión.

    Visualización:
        Muestra el coste de la visita actual.
        Muestra el Gasto Total acumulado.

Objetivo: Practicar la validación de Checkboxes (Arrays) unida a una función matemática que opera con esos datos.-->

<?php 
    require_once '0_funciones.php';
    session_start();
    
    //Variables
    $errores = [];
    $nombre = '';
    $tratamiento = [];
    $tratamientos = ['pocion','cirugia','afilado'];

    //Variables de Sesion
    if(!isset($_SESSION['gasto_total'])){
        $_SESSION['gasto_total'] = 0;
    }

    //Reiniciar
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar'])){
        session_destroy();
        header('Location: 10_clinica.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']) ?? '';
        $raza = trim($_POST['raza']) ?? '';
        $tratamiento = $_POST['tratamiento'] ?? [];

        if(empty($nombre)){
            $errores['nombre'] = "Tienes que rellenar el nombre de la bestia";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($raza)){
            $errores['raza'] = "Tienes que rellenar la raza de la bestia";
        }else{
            $razaBien = $raza;
        }

        if(empty($tratamiento)){
            $errores['tratamiento'] = "Tienes que coger el tratamiento";
        }if(!empty(array_diff($tratamiento,$tratamientos))){
            $errores['tratamiento'] = "Tratamiento mal elegido!";
        }if(count($tratamiento) < 1){
            $errores['tratamiento'] = "Tienes que elegir al menos 1 tratamento";
        }else{
            $tratamientoBien = $tratamiento;
        }

        if(empty($errores)){
            
            // 1. LLAMAR A LA FUNCIÓN
            // Le pasamos el array limpio ($tratamientoBien)
            $costeActual = calcularCoste($tratamientoBien);

            // 2. ACUMULAR EN SESIÓN
            // (Asegúrate de haber inicializado $_SESSION['gasto_total'] = 0 arriba del todo)
            $_SESSION['gasto_total'] += $costeActual;

            // Opcional: Guardar el coste actual para mostrarlo abajo
            $mensajeExito = "Tratamiento registrado. Coste: $costeActual monedas.";
            
            // Limpiar formulario
            $nombre = "";
            $raza = "";
            $tratamiento = [];
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica de Saruman</title>
</head>
<body>
    <h1>Bienvenido a la Clínica de Saruman</h1>
    <h2>Bestia que vamos a tratar</h2>

    <form action="" method="POST">
        <p>
        <label for="nombre">
            Nombre de la bestia <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($nombre ?? '')?>" >
        </label></p>
        <?= $errores['nombre'] ?? '' ?>
        <p>
        <label for="raza">
            Raza de la bestia <input type="text" name="raza" id="raza" value="<?= htmlspecialchars($raza ?? '') ?>" >
        </label></p>
        <?= $errores['raza'] ?? '' ?>
        <p><b>Tratamiento</b></p>
        <label for="pocion">
            <input type="checkbox" name="tratamiento[]" id="pocion" value='pocion' <?php if(in_array('pocion',$tratamiento)) echo 'checked' ?> >Pocion de vida
        </label>
        <label for="afilado">
            <input type="checkbox" name="tratamiento[]" id="afilado" value='afilado' <?php if(in_array('afilado',$tratamiento)) echo 'checked' ?> >Afilado de los dientes
        </label>
        <label for="cirugia">
            <input type="checkbox" name="tratamiento[]" id="cirugia" value='cirugia' <?php if(in_array('cirugia',$tratamiento)) echo 'checked' ?> >Cirugía Oscura
        </label>
        <p><?= $errores['tratamiento'] ?? '' ?></p>
        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>

    <?php if(isset($costeActual)): ?>
        <h2>Resumen de la Visita</h2>
        <p><?= $mensajeExito ?></p>
        <p><strong>Coste de esta visita:</strong> <?= $costeActual ?> monedas.</p>
    <?php endif; ?>

    <h3>Deuda Total de Isengard: <?= $_SESSION['gasto_total'] ?> monedas</h3>

    <form action="" method="POST">
        <input type="submit" name="cerrar" value="Cerrar Caja (Reset)">
    </form>
</body>
</html>