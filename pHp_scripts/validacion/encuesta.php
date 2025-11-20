<!--Ejercicio 6: Encuesta de Satisfacción del Cliente
Una empresa desea conocer la opinión de sus clientes mediante una encuesta en línea. Crea un
formulario en PHP que permita recoger la siguiente información:
• Nombre Completo: Debe tener entre 5 y 100 caracteres, solo letras y espacios. No puede estar
vacío.
• Método de contacto preferido (Select): El usuario debe seleccionar entre: (Debe seleccionar
una opción y no puede quedar vacío).
◦ Correo Electrónico
◦ Teléfono
◦ WhatsApp
• Correo Electrónico: Debe ser un formato válido. Si el método de contacto preferido es correso
electrónico, no puede estar vacío.
• Teléfono: Debe tener 9 dígitos. Si el método de contacto es teléfono o whatsapp no puede estar
vacío.
• Nivel de Satisfacción (Radio Button): El usuario debe seleccionar una opción entre: (Debe
seleccionarse una opción obligatoriamente).
◦ Muy Satisfecho
◦ Satisfecho
◦ Neutral
◦ Insatisfecho
◦ Muy Insatisfecho
• Elija tres aspectos a mejorar (Checkbox): Se pueden seleccionar como máximo tres opciones
de una lista de mejoras como:
◦ Atención al cliente
◦ Tiempo de espera
◦ Calidad del producto
◦ Precio
◦ Experiencia en la web
Cuando los datos sean válidos, mostrar el resumen de la encuesta.-->

<?php
    var_dump($_POST);
    $errores=[];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=trim($_POST['nombre']);
        $contacto=$_POST['contacto'];
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $telefono=trim($_POST['telefono']);


        //Nombre
        if(empty($nombre)){
            $errores['nombre'] = "El nombre no puede estar vacío";
        }elseif(!preg_match('/^[a-zA-Z ]{5,100}$/',$nombre)){
            $errores['nombre'] = "El nombre tiene que medir minimo 5 caracteres y solo constar de letras.";
        }else{
            $nombre_bien=$nombre;
        }

        //Contacto
        $formas_contacto = ['correo','telefono','whatsapp'];
        if(empty($contacto)){
            $errores['contacto'] = "Debes seleccionar un método de contacto";
        }elseif (!in_array($contacto, $formas_contacto)){
            $errores['contacto'] = "Método de contacto no válido";
        }else{
            $contacto_bien=$contacto;
        }

        //email
        if($contacto == 'correo' && empty($email)){
            $errores['email'] = "Debes introducir un correo electrónico.";
        }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errores['email'] = "Correo no válido";
        }else{
            $email_bien=$email;
        }

        //Teléfono
        if($contacto == 'telefono' && empty($telefono)){
            $errores['telefono'] = "Debes introducir un teléfono";
        }elseif (!preg_match("/^6\d{8}$/",$telefono)){
            $errores['telefono'] = "El teléfono debe tener 9 dígitos y empezar por 6";
        }else{
            $tel_bien=$telefono;
        }

        if(empty($errores)){
            echo "Nombre: $nombre_bien <br/>";
            echo "Contacto: $contacto_bien <br/>";
            echo "email: $email_bien <br/>";
            echo "Teléfono: $tel_bien <br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Satisfacción</title>
</head>
<body>
    <h1><p>Formulario de Encuesta de Satisfacción del Cliente</p></h1>
    <form action="" method="POST">
        <p>
            Nombre Completo: 
            <input type="text" placeholder="Nombre Completo" name="nombre" value="<?php echo htmlspecialchars($nombre_bien) ?? ''?>"></p>
            <?php echo $errores['nombre'] ?? ''?> <!-- Sive para mostrar los errores-->
        <p>
            <label for="metodoContacto">Método de contacto preferido:</label>
            <select id="metodoContacto" name="contacto" value>
                <option value="">Seleccione una opcion</option>
                <option value="correo" <?php if(isset($contacto_bien) && $contacto_bien == "correo") echo "selected"?>>Correo Electrónico</option>
                <option value="telefono" <?php if(isset($contacto_bien) && $contacto_bien == "telefono") echo "selected"?>>Teléfono</option>
                <option value="whatsapp" <?php if(isset($contacto_bien) && $contacto_bien == "whatsapp") echo "selected"?>>WhatsApp</option>
            </select>
            <?php echo $errores['contacto'] ?? ''?> <!-- Sive para mostrar los errores-->
        </p>
        <p>
            <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($email_bien) ?? ''?>"></p>
            <?php echo $errores['email'] ?? ''?> <!-- Sive para mostrar los errores-->
        <p>
            <label for="telefono">Teléfono:</label>
                <input type="text" placeholder="Teléfono" value="<?php echo htmlspecialchars($telefono) ?? '' ?>"></p>
                <?php echo $errores['telefono'] ?? '' ?>
        <p>
            <label for="nivelSatisfaccion">Nivel de Satisfacción:</label><br>
                <input type="radio" id="muySatisfecho" name="nivelSatisfaccion" value="muySatisfecho">
            <label for="muySatisfecho">Muy Satisfecho</label><br>
                <input type="radio" id="satisfecho" name="nivelSatisfaccion" value="satisfecho">
            <label for="muySatisfecho">Muy Satisfecho</label><br>
                <input type="radio" id="neutral" name="nivelSatisfaccion" value="neutral">
            <label for="neutral">Neutral</label><br>
                <input type="radio" id="insatisfecho" name="nivelSatisfaccion" value="insatisfecho">
            <label for="insatisfecho">Insatisfecho</label><br>
                <input type="radio" id="muyInsatisfecho" name="nivelSatisfaccion" value="muyInsatisfecho">
            <label for="muyInsatisfecho">Muy Insatisfecho</label><br>
        </p>
        Elija tres aspectos a mejorar:
            <br>
                <input type="checkbox" name="mejoras[]" value="atencionCliente">
            <label for="atencionCliente">Atención al cliente</label><br>
                <input type="checkbox" name="mejoras[]" value="tiempoEspera">
            <label for="tiempoEspera">Tiempo de espera</label><br>
                <input type="checkbox" name="mejoras[]" value="calidadProducto">
            <label for="calidadProducto">Calidad del producto</label><br>
                <input type="checkbox" name="mejoras[]" value="precio">
            <label for="precio">Precio</label><br>
                <input type="checkbox" name="mejoras[]" value="experienciaWeb">
            <label for="experienciaWeb">Experiencia en la web</label><br>
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>