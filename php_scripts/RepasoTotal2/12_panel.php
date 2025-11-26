<?php 
    require_once '12_iniciar_sesion.php';
    require_once 'funciones.php';

    $errores = [];
    $codigo = '';
    $email = '';
    $tropa = '';
    $tropas = ['grunts','incursores','chamanes'];
    $prioridad = '';
    $prioridades = ['normal','urgente'];
    $equipamiento = [];
    $equipamientos = ['armas','armaduras','joyeria'];
    $cantidad = '';

    if(empty($_SESSION['usuario'])){
        header('Location:12_login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $codigo = trim($_POST['codigo'] ?? '');
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $tropa = $_POST['tropa'] ?? '';
        $cantidad = filter_var($_POST['cantidad'],FILTER_SANITIZE_NUMBER_INT);
        $prioridad = $_POST['prioridad'] ?? '';
        $equipamiento = $_POST['equipamiento'] ?? [];
        $autorizacion = $_POST['autorizacion'] ?? '';
        $cantidad = filter_var($_POST['cantidad'],FILTER_SANITIZE_NUMBER_INT);

        //CODIGO DE MISION
        if(empty($codigo)){
            $errores['codigo'] = "Error: Tienes que ingresar un código de mision";
        }elseif (!preg_match("/^M-\d{3}$/",$codigo)){
            $errores['codigo'] = "Error: Código de misión incorrecto";
        }else{
            $codigoBien = $codigo;
        }

        //EMAIL
        if(empty($email)){
            $errores['email'] = "Error: Tienes que ingresar un email";
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Error: Tienes que ingresar un email válido";
        }else{
            $emailBien = $email;
        }

        //TROPAS
        if(empty($tropa)){
            $errores['tropa'] = "Error: Tienes que elegir 1 tropa";
        }elseif (!in_array($tropa,$tropas)){
            $errores['tropa'] = "Error: Tienes que elegir 1 tropa de las que yo te de!!!";
        }else{
            $tropaBien = $tropa;
        }

        //CANTIDAD
        if(empty($cantidad)){
            $errores['cantidad'] = "Error: Tienes que decirnos la cantidad de tropas que necesitas";
        }elseif (!filter_var($cantidad,FILTER_VALIDATE_INT)){
            $errores['cantidad'] = "Error: La cantidad debe de ser un número entero";
        }else{
            $cantidadBien = $cantidad;
        }

        //PRIORIDAD
        if(empty($prioridad)){
            $errores['prioridad'] = "Error: Tienes que elegir la prioridad";
        }elseif (!in_array($prioridad,$prioridades)){
            $errores['prioridad'] = "Error: Tienes que elegir una prioridad que yo te de!!!";
        }else{
            $prioridadBien = $prioridad;
        }

        //EQUIPAMIENTO
        if(empty($equipamiento)){
            $errores['equipamiento'] = "Error: Tienes que elegir 1 equipamiento";
        }elseif (!empty(array_diff($equipamiento,$equipamientos))){
            $errores['equipamiento'] = "Error: Tienes que elegir unos equipamientos que yo te de!!!";
        }

        //AUTORIZACIÓN
        if(empty($autorizacion)){
            $errores['autorizacion'] = "Error: Tienes que añadir la autorización";
        }elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{8,}$/",$autorizacion)){
            $errores['autorizacion'] = "Error: La autorización tiene que incluir al menos 1 letra, 1 número y ser mínimo de 8 caracteres";
        }else{
            $autorizacionBien = password_hash($autorizacion,PASSWORD_DEFAULT);
        }

        if(empty($errores)){
            $costeTotal = calcular_coste_total($tropaBien,$cantidadBien,$equipamiento,$prioridadBien);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística</title>
</head>
<body>
    <h1>Bienvenido Thrall</h1>
    <form action="" method="POST">
        <label for="codigo">Código de misión 
            <p><input type="text" name="codigo" id="codigo" placeholder="Código de Misión" value="<?= htmlspecialchars($codigo ?? '') ?>" ></p>
        </label>
        <p><?= $errores['codigo'] ?? '' ?></p>
        
        <label for="email">Email 
            <p><input type="text" name="email" id="email" placeholder="email" value="<?= htmlspecialchars($email ?? '') ?>" ></p>
        </label>
        <p><?= $errores['email'] ?? '' ?></p>
        
        <p>Tropas</p>
        <select name="tropa" id="tropa">
            <option value="">Elije una tropa</option>
            <option value="grunts" <?php if($tropa == 'grunts') echo 'selected'?> >Grunts</option>
            <option value="incursores" <?php if($tropa == 'incursores') echo 'selected'?> >Incursores</option>
            <option value="chamanes" <?php if($tropa == 'chamanes') echo 'selected'?> >Chamanes</option>
        </select>
        <p><?= $errores['tropa'] ?? '' ?></p>
        
        <p><label for="cantidad">Cantidad
            <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?= htmlspecialchars($cantidad ?? '') ?>" >
        </label>
        <p><?= $errores['cantidad'] ?? '' ?></p>

        </p>
        
        <p>Prioridad</p>
        <label for="normal"><input type="radio" name="prioridad" value="normal" id="normal" <?php if($prioridad == 'normal') echo 'checked'?> >Normal</label>
        <label for="urgente"><input type="radio" name="prioridad" value="urgente" id="urgente" <?php if($prioridad == 'urgente') echo 'checked'?> >Urgente</label>
        <p><?= $errores['prioridad'] ?? '' ?></p>
        
        <p>Equipamiento</p>
        <label for="armas"><input type="checkbox" name="equipamiento[]" id='armas' value="armas" <?php if(in_array('armas',$equipamiento)) echo 'checked' ?> >Armas</label>
        <label for="armaduras"><input type="checkbox" name="equipamiento[]" id='armaduras' value="armaduras" <?php if(in_array('armaduras',$equipamiento)) echo 'checked' ?> >Armaduras</label>
        <label for="joyeria"><input type="checkbox" name="equipamiento[]" value="joyeria" id='joyeria' <?php if(in_array('joyeria',$equipamiento)) echo 'checked' ?> >Joyeria</label>
        <p><?= $errores['equipamiento'] ?? '' ?></p>
        
        <p><label for="clave">Clave de Autorización
            <input type="password" name="autorizacion" id="autorizacion" placeholder="Clave de Autorización">
        </label></p>
        <p><?= $errores['autorizacion'] ?? '' ?></p>
        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>

    <?php if($_SERVER['REQUEST_METHOD']=='POST' && (empty($errores))): ?>
        <p>Código de Misión: <?= htmlspecialchars($codigoBien) ?></p>
        <p>eMail: <?= htmlspecialchars($emailBien) ?></p>
        <p>Tropa Elegida: <?= $tropaBien ?></p>
        <p>Cantidad de Tropas: <?= htmlspecialchars($cantidadBien) ?></p>
        <p>Prioridad: <?= $prioridadBien ?></p>
        <p>Equipamiento:</p>
        <ul>
            <?php foreach($equipamiento as $equipo): ?>
                <li><?= $equipo ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Clave de Autorización : <?= $autorizacionBien ?></p>

        <p><b>El coste total de la patruya es <?= $costeTotal ?> monedas de oro</b></p>
    <?php endif; ?>
</body>
</html>