<?php
    require_once 'funciones.php';
    $errores = [];
    $nombre = "";
    $email = "";
    $telefono = "";
    $years = "";
    $ramaTecnica = "";
    $pass = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre'] ?? '');
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'],FILTER_SANITIZE_NUMBER_INT);
        $years = filter_var($_POST['years'],FILTER_SANITIZE_NUMBER_INT);
        $ramaTecnica = $_POST['ramaTecnica'] ?? '';
        $pass = $_POST['pass'] ?? '';

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que introducir tu nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($email)){
            $errores['email'] = "Error: Tienes que introducir tu email";
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Error: Tienes que introducir un email válido";
        }else{
            $emailBien = $email;
        }

        if(empty($telefono)){
            $errores['telefono'] = "Error: Tienes que introducir tu teléfono";
        }elseif (!preg_match("/^[6-9]\d{8}$/",$telefono)){
            $errores['telefono'] = "Error: El téfono tiene que empezar por 6,7,8 o 9 y tiene que tener solo 9 dígitos máximo";
        }else{
            $telefonoBien = $telefono;
        }

        if(empty($pass)){
            $errores['pass'] = "Error: Tienes que introducir una contraseña";
        }elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{8,}$/",$pass)){
            $errores['pass'] = "Error: La contraseña solo puede tener letras, números y '_'";
        }else{
            $passBien = password_hash($pass,PASSWORD_DEFAULT);
        }

        if(empty($years)){
            $errores['years'] = "Error: Tienes que incluir los años de servicio";
        }elseif (!filter_var($years,FILTER_VALIDATE_INT)){
            $errores['years'] = "Error: Los años deben ser un número entero";
        }else{
            $yearsBien = $years;
        }

        if(empty($ramaTecnica)){
            $errores['ramaTecnica'] = "Error: Tienes que elegir una rama técnica";
        }else{
            $ramaTecnicaBien = $ramaTecnica;
        }

        if(empty($errores)){
            $salario = calcular_salario_esperado($yearsBien,$ramaTecnicaBien);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Ingenieros</title>
</head>
<body>
    <h1>Registro de Ingenieros de Gallywix</h1>
    <h2>Introduce tus datos para darte de alta en la plataforma</h2>

    <form action="" method="POST">
        <label for="nombre">
            <p><input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" value="<?= ($_POST['nombre'] ?? '') ?>"></p>
        </label>
        <?= $errores['nombre'] ?? '' ?>
        <label for="email">
            <p><input type="email" name="email" id="email" placeholder="Introduce tu email" value=" <?= ($_POST['email'] ?? '') ?>"></p>
        </label>
        <?= $errores['email'] ?? '' ?>
        <label for="telefono">
            <p><input type="text" name="telefono" id="telefono" placeholder="Introduce tu teléfono" value="<?= ($_POST['telefono'] ?? '') ?>"></p>
        </label>
        <?= $errores['telefono'] ?? '' ?>
        <label for="pass">
            <p><input type="password" name="pass" id="pass" placeholder="Introduce tu contraseña" ></p>
        </label>
        <?= $errores['pass'] ?? '' ?>
        <label for="years">
            <p><input type="text" name="years" id="years" placeholder="Años de servicio" value="<?= ($_POST['years'] ?? '') ?>" ></p>
        </label>
        <p><select name="ramaTecnica" id="ramaTecnica">
            <option value="">Elige tu rama técnica</option>
            <option value="explosivos" <?php if($ramaTecnica == 'explosivos') echo 'selected'?> >Explosivos</option>
            <option value="mecanica" <?php if($ramaTecnica == 'mecanica') echo 'selected'?>>Mecanica</option>
            <option value="alquimia" <?php if($ramaTecnica == 'alquimia') echo 'selected'?>>Alquimia</option>
        </select></p>
        <?= $errores['ramaTecnica'] ?? '' ?>

        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>

    <?php if(($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($errores))): ?>
        <p>Has sido contratado <?= htmlspecialchars($nombreBien) ?></p>
        <p>eMail <?= htmlspecialchars($emailBien) ?></p>
        <p>Telefono <?= htmlspecialchars($telefonoBien) ?></p>
        <p>Años de experiencia <?= htmlspecialchars($yearsBien) ?> años</p>
        <p>Especialidad <?= $ramaTecnicaBien ?></p>

        <p>Salario <?= htmlspecialchars($salario) ?> monedas de oro</p>
    
    <?php endif; ?>
</body>
</html>