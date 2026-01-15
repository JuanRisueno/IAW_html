<?php
    
    echo password_hash('oretania', PASSWORD_DEFAULT);

    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>OretaFilms</title>
</head>
<body>
    <h1>OretaFilms</h1>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Nombre de Usuario">
        <br>
        <input type="text" name="pass" id="pass" placeholder="Contraseña">
        <br>
        <input type="submit" value="Entrar">
        <a href="nuevoUsuario.php">Registrar</a>
    </form>
</body>
</html>