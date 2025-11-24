<!--
⚔️ La Logística de Mordor - Fase 2 (8_arsenal.php) Dificultad: ⭐⭐⭐ (Intermedio)
Concepto: Protección de Páginas (Control de Acceso) y Logout.

El Arsenal de Mordor
Esta es la zona restringida. Aquí se guardan las armas para la guerra. Solo los orcos que hayan fichado en el Puesto de Guardia ('8_login.php') pueden ver este inventario.

Tu misión es proteger esta página y mostrar el contenido solo a los autorizados.

Reglas del Arsenal:
    1. Configuración: Al igual que el login, lo primero es cargar la configuración de seguridad: require_once 'config_mordor.php'.
    
    2. El Portero (Seguridad Crítica):
        - Antes de mostrar NADA de HTML, comprueba si existe la variable de sesión del orco ($_SESSION['orco']).
        - Si NO existe (es un espía o alguien que se saltó el login): Expúlsalo inmediatamente a '8_login.php' usando header() y exit.

    3. Contenido (Solo si pasa el portero):
        - Muestra un título: "Arsenal de Mordor - Guardia de turno: [Nombre del Orco]".
        - Muestra una lista simple (HTML) de armas disponibles (ej: Cimitarra, Arco, Escudo).

    4. Fin de Turno (Logout):
        - Añade un botón o formulario para "Cerrar Turno".
        - Si se pulsa: Destruye la sesión y redirige al orco de vuelta al Puesto de Guardia ('8_login.php').
-->
<?php 
    require_once 'config_mordor.php';
    require_once '0_funciones.php';

    if(!isset($_SESSION['orco'])){
        header('Location:8_login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salir'])){
        session_destroy();
        header('Location:8_login.php');
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARSENAL</title>
</head>
<body>
    <h1>Arsenal de Mordor - Guardia de turno: <?= $_SESSION['orco'] ?> </h1>

    <ul>
        <li>Cimitarra</li>
        <li>Arco</li>
        <li>Escudo</li>
    </ul>

    <form action="" method="POST">
        <p><input type="submit" name="salir" value="Salir del Arsenal"></p>
    </form>
</body>
</html>
