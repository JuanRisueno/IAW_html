<?php
    $errores=[];
    $nombre="";
    $pass="";
    $edad="";
    $cp="";
    $telefono="";
    $email="";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nombre=trim($_POST['nombre']);
        $pass=trim($_POST['pass']);
        $edad=filter_var($_POST['edad'],FILTER_SANITIZE_NUMBER_INT);
        $cp=filter_var($_POST['cp'],FILTER_SANITIZE_NUMBER_INT);
        $telefono=filter_var($_POST['telefono'],FILTER_SANITIZE_NUMBER_INT);
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

        //Nombre
        if(empty($nombre)){
            $errores['nombre'] = "Tienes que introducir un nombre.";
        }elseif (!preg_match("/^[a-zA-Z ]{8,}$/",$nombre)){
            $errores['nombre'] = "El nombre tiene que contener al menos 8 carácteres y solo valen letras y espacios.";
        }else{
            $nombreBien=$nombre;
        }

        //Contraseña
        if(empty($pass)){
            $errores['pass'] = "Tienes que introducir una contraseña.";
        }elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{8,}$/",$pass)){
            $errores['pass'] = "La Contraseña tiene que tener al menos 8 caracteres, letras y números.";
        }else{
            $passBien=$pass;
        }

        //Edad
        if(empty($edad)){
            $errores['edad'] = "Tienes que rellenar el campo edad";
        }elseif (filter_var($edad,FILTER_VALIDATE_INT) === false){
            $errores['edad'] = "La edad tiene que ser un número entero";
        }elseif ($edad < 18){
            $errores['edad'] = "Tienes que ser mayor de edad (+18) para registrarte";
        }else{
            $edadBien=$edad;
        }

        //Código Postal
        if(empty($cp)){
            $errores['cp'] = "Tienes que rellenar el Código Postal";
        }elseif (!preg_match("/^\d{5}$/",$cp)){
            $errores['cp'] = "El Código Postal tienen que ser 5 números";
        }else{
            $cpBien=$cp;
        }

        //Teléfono
        if(empty($telefono)){
            $errores['telefono'] = "Tienes que rellenar el teléfono";
        }elseif (!preg_match("/^6\d{8}$/",$telefono)){
            $errores['telefono'] = "El teléfono tiene que ser de 9 dígitos y empezar por 6";
        }else{
            $telefonoBien=$telefono;
        }

        //email
        if(empty($email)){
            $errores['email'] = "Tienes que rellenar el email";
        }elseif (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            $errores['email'] = "El email tiene que ser con formato email";
        }else{
            $emailBien=$email;
        }

        //SinErrores
        if(empty($errores)){
            echo "Nombre: $nombreBien";
            echo "Edad: $edadBien";
            echo "Código Postal: $cpBien";
            echo "Teléfono: $telefonoBien";
            echo "eMail: $emailBien";
        }

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Completo</title>
</head>
<body>
    <h1>Vamos a completar un registro completo</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre) ?? '' ?>">
            <?php echo $errores['nombre'] ?? '' ?>
        </label>
        <br/>
        <label for="pass">Contraseña
            <input type="password" name="pass" placeholder="Contraseña">
            <?php echo $errores['pass'] ?? '' ?>
        </label>
        <br/>
        <label for="edad">Edad
            <input type="text" name="edad" placeholder="Edad" value="<?= htmlspecialchars($edad) ?? ''?>"> <!--Otra forma de hacerlo-->
            <?= $errores['edad'] ?? '' ?> <!--Otra forma de hacerlo-->
        </label>
        <br/>
        <label for="cp">Código Postal
            <input type="text" name="cp" placeholder="Código Postal" value="<?php echo htmlspecialchars($cp) ?? '' ?>">
            <?php echo $errores['cp'] ?? '' ?>
        </label>
        <br/>
        <label for="telefono">Teléfono
            <input type="text" name="telefono" placeholder="Teléfono" value="<?= htmlspecialchars($telefono) ?? '' ?>">
            <?= $errores['telefono'] ?? '' ?>
        </label>
        <br/>
        <label for="email">email
            <input type="email" name="email" placeholder="eMail" value="<?php echo htmlspecialchars($email) ?? '' ?>">
            <?= $errores['email'] ?? '' ?>
        </label>
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>