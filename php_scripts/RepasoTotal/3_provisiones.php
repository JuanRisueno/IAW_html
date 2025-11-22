<!--Sam Gamyi está ultimando los preparativos para el largo viaje hacia el Monte del Destino. Para asegurarse de que Frodo y él no pasen hambre ni peligro, necesita organizar meticulosamente cada objeto que meten en el carro.

Debes crear una herramienta web que permita a Sam registrar cada suministro individualmente. Para cada objeto, Sam debe escribir su Nombre (por ejemplo: "Pan de Lembas") y seleccionar su Tipo desde un desplegable predefinido (las opciones permitidas son: "Comida", "Armas" o "Varios").

El sistema debe cumplir las siguientes normas de la Tierra Media:

    Validación Estricta: No se pueden guardar objetos sin nombre, y el tipo seleccionado debe ser obligatoriamente uno de los tres permitidos (protección contra orcos que intenten manipular el formulario).

    Memoria del Viaje: Cada vez que Sam añada un objeto válido, este debe guardarse en la lista del carro y permanecer ahí aunque se recargue la página.

    Visualización: Debajo del formulario, debe mostrarse la lista completa de provisiones que llevan cargadas hasta el momento, indicando el nombre y el tipo de cada una.

    Empezar de Cero: Debe existir un mecanismo para "Vaciar el Carro" completamente si deciden reorganizar el equipaje.-->

<?php 
    session_start();
    require_once '0_funciones.php';

    $errores=[];
    $provision='';
    $tipo='';

    $tiposPermitidos=['comida','armas','varios'];

    //Reiniciar la sesión
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vaciar'])){
        session_destroy();
        header('Location: 3_provisiones.php');
        exit;
    }

    //Inicializar el array
    if(!isset($_SESSION['mochila'])){
        $_SESSION['mochila']=[];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['provision'])){
        $provision = sanear($_POST['provision'] ?? '');
        $tipo = $_POST['tipoProvision'] ?? '';

        //Validación del nombre de la provisión
        if(empty($provision)){
            $errores['provision'] = "<br>Tienes que poner una provisión";
        }

        //Validación del Select
        if(empty($tipo)){
            $errores['tipo'] = "<br> Tienes que elegir un tipo.";
        }elseif (!existe($tipo,$tiposPermitidos)){
            $errores['tipo'] = "<br> Tipo no válido (intento de hackeo)";
        }

        //Guardar Sesión
        if(empty($errores)){
            $_SESSION['mochila'][] = [
                'nombre' => $provision,
                'tipo' => $tipo
            ];

            $provision = '';
            $tipo = '';
        }

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provisiones</title>
</head>
<body>
    <h1>Provisiones de Sam Gamyi</h1>
    <h2>Estas son las provisiones que Sam se va a llevar</h2>
    <form method="POST" action="">
        <label for="provision">Provision</label>
        <p><input type="text" name="provision" placeholder="Provisión a añadir"></p>
        <p><?= $errores['provision'] ?? '' ?></p>

        <label for="tipo">Tipo de la provisión</label>
        <select name="tipoProvision" id="tipo">
            <option value="">Elije una opción:</option>
            <option value="comida" <?php if($tipo == 'comida') echo 'selected' ?>>Comida</option>
            <option value="armas" <?php if($tipo == 'armas') echo 'selected' ?>>Armas</option>
            <option value='varios' <?php if($tipo == 'varios') echo 'selected' ?>>Varios</option>
        </select>
        <?= $errores['tipo'] ?? '' ?>
        <p><input type="submit" value="Añadir Provision"></p>
    </form>
    <form method="POST" action="">
        <input type="submit" value="Vaciar el Carro" name="vaciar">
    </form>
    <h2>Contenido de la mochila de Sam</h2>
    <ul>
        <?php foreach($_SESSION['mochila'] as $elemento):?>
            <li><?= htmlspecialchars($elemento['nombre']) ?> - <?= htmlspecialchars($elemento['tipo']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>