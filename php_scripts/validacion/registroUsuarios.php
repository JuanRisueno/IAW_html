<!--Ejercicio 2: Formulario de registro de usuarios
Crea un script PHP que maneje un formulario de registro de usuario. Este formulario debe recoger el
nombre, correo electrónico, contraseña, número de teléfono y edad. Al enviar el formulario, el script
debe sanear y validar los datos ingresados, mostrando mensajes de error para los campos no válidos y
mostrando los valores válidos.
Descripción de las Validaciones:
• Nombre: Debe estar entre 3 y 50 caracteres, no puede estar vacío y solo se permiten letras y
espacios.
• Correo Electrónico: No puede estar vacío y debe ser un formato válido.
• Contraseña: No puede estar vacía y debe tener al menos 8 caracteres.
• Teléfono: Debe tener exactamente 10 dígitos y no puede estar vacío.
• Edad: Debe ser un número entero entre 0 y 120 y no puede estar vacío.
Cuando sean válidos mostrar los datos del registro-->

<?php 
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = trim($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
    $edad = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT);

    if(empty($nombre)){
        $errores['nombre'] = "El nombre no puede estar vacío";
    }elseif(mb_strlen($nombre) < 3 || mb_strlen($nombre) > 50){
        $errores['nombre'] = "El nombre tiene que tener entre 3 y 50 caracteres";
    }elseif(!preg_match('/^[a-zA-Z ]{3,50}/', $nombre)){
        $errores['nombre'] = "El nombre tiene que tener solo letras mayúsculas, minúsculas o espacios";
    }else{
        $nombre_bien = $nombre;
    }

    if(empty($email)){
        $errores['email'] = "El correo electrónico no puede estar vacío";
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
        $errores['email'] = "El correo electrónico tiene que ser un formato válido";
    }else{
        $email_bien = $email;
    }

    if(empty($password)){
        $errores['password'] = "La contraseña no puede estar vacía";
    }elseif(mb_strlen($password) < 8){
        $errores['password'] = "La contraseña tiene que tener más de 8 caracteres";
    }else{
        $password_bien = $password;
    }

    if(empty($telefono)){
        $errores['telefono'] = "El teléfono no puede estar vacío";
    }elseif(mb_strlen($telefono) != 10){
        $errores['telefono'] = "El teléfono tiene que tener 10 digitos";
    }else{
        $telefono_bien = $telefono;
    }

    if(empty($edad)){
        $errores['edad'] = "La edad no puede estar vacía";
    }elseif($edad <= 0 || $edad >= 121 ){
        $errores['edad'] = "La edad tiene que estar entre 0 años y 120 años";
    }else{
        $edad_bien = $edad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h1>Registro de Usuarios</h1>
    <form action="" method="post">
        <p><input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre) ?? ''; ?>"/></p>
        <?php echo $errores['nombre'] ?? ''?> <!-- Sive para mostrar los errores-->
        <p><input type="text" id="email" name="email" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($email) ?? ''; ?>"/></p>
        <?php echo $errores['email'] ?? ''?>
        <p><input type="text" id="password" name="password" placeholder="Contraseña" value="<?php echo htmlspecialchars($password) ?? ''; ?>"/></p>
        <?php echo $errores['password'] ?? ''?>
        <p><input type="text" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo htmlspecialchars($telefono) ?? ''; ?>"/></p>
        <?php echo $errores['telefono'] ?? ''?>
        <p><input type="text" id="edad" name="edad" placeholder="Edad" value="<?php echo htmlspecialchars($edad) ?? ''; ?>"/></p>
        <?php echo $errores['edad'] ?? ''?>
        <p><input type="submit" value="Enviar"/></p>
    </form>
</body>
</html>