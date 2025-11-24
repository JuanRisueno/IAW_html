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
        $nivelSatisfacion=$_POST['nivelSatisfaccion'] ?? '';
        $mejorar=$_POST['mejoras'] ?? [];

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
        }elseif(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errores['email'] = "Correo no válido";
        }else{
            $email_bien=$email;
        }

        //Teléfono
        if($contacto == 'telefono' && empty($telefono)){
            $errores['telefono'] = "Debes introducir un teléfono";
        }elseif (!empty($telefono) && !preg_match("/^[6-9]\d{8}$/",$telefono)){
            $errores['telefono'] = "El teléfono debe tener 9 dígitos y empezar por 6, 7, 8 o 9";
        }else{
            $tel_bien=$telefono;
        }

        //Nivel de Satisfacción - Radio
        $valoresSatisfaccion=['muySatisfecho','satisfecho','neutral','insatisfecho','muyInsatisfecho'];
        if(!isset($_POST['nivelSatisfaccion'])){
            $errores['nivelSatisfaccion'] = "Debes seleccionar uno";
        }elseif(!in_array($nivelSatisfacion,$valoresSatisfaccion)){
            $errores['nivelSatisfaccion'] = "Opción no válida";
        }else{
            $nivelSatisfacion_bien = $nivelSatisfacion;
        }

        //Checkbox
        $mejorarValoresValidos=['atencionCliente','tiempoEspera','calidadProducto','precio','experienciaWeb'];
        if(count($mejorar) > 3){
            $errores['mejoras'] = "Debes seleccionar al menos 3 opciones" ; 
        }elseif(!empty(array_diff($mejorar,$mejorarValoresValidos))){
            $errores['mejoras'] = "Hay un valor no válido." ; 
        }else{
            $mejorar_bien=$mejorar;
        }

        //Sin Errores
        if(empty($errores)){
            echo "Nombre: ".htmlspecialchars($nombre_bien)." <br/>";
            echo "Contacto: ".htmlspecialchars($contacto_bien)."<br/>";
            echo "email: ".htmlspecialchars($email_bien)." <br/>";
            echo "Teléfono: ".htmlspecialchars($tel_bien)." <br/>";
            echo "Nivel de Satisfacción: ".htmlspecialchars($nivelSatisfacion_bien)." <br/>";
            foreach($mejorar as $m){
                echo $m."</br>";
            }
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
                <input type="email" name="email" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($email_bien ?? '')?>"></p>
            <?php echo $errores['email'] ?? ''?> <!-- Sive para mostrar los errores-->
        <p>
            <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo htmlspecialchars($telefono) ?? ''?>"></p>
                <?php echo $errores['telefono'] ?? '' ?>
        <p>
            <label for="nivelSatisfaccion">Nivel de Satisfacción:</label><br>
                <input type="radio" id="muySatisfecho" name="nivelSatisfaccion" value="muySatisfecho" <?php if(isset($nivelSatisfacion_bien) && $nivelSatisfacion_bien == "muySatisfecho") echo "checked"?>>
            <label for="muySatisfecho">Muy Satisfecho</label><br>
                <input type="radio" id="satisfecho" name="nivelSatisfaccion" value="satisfecho" <?php if(isset($nivelSatisfacion_bien) && $nivelSatisfacion_bien == "satisfecho") echo "checked"?>>
            <label for="muySatisfecho">Muy Satisfecho</label><br>
                <input type="radio" id="neutral" name="nivelSatisfaccion" value="neutral" <?php if(isset($nivelSatisfacion_bien) && $nivelSatisfacion_bien == "neutral") echo "checked"?>>
            <label for="neutral">Neutral</label><br>
                <input type="radio" id="insatisfecho" name="nivelSatisfaccion" value="insatisfecho" <?php if(isset($nivelSatisfacion_bien) && $nivelSatisfacion_bien == "insatisfecho") echo "checked"?>>
            <label for="insatisfecho">Insatisfecho</label><br>
                <input type="radio" id="muyInsatisfecho" name="nivelSatisfaccion" value="muyInsatisfecho" <?php if(isset($nivelSatisfacion_bien) && $nivelSatisfacion_bien == "muyInsatisfecho") echo "checked"?>>
            <label for="muyInsatisfecho">Muy Insatisfecho</label><br>
            <?= $errores['nivelSatisfaccion'] ?? '' ?>
        </p>

        Elija tres aspectos a mejorar:
            <br>
                <input type="checkbox" name="mejoras[]" value="atencionCliente" <?php if(isset($mejorar_bien) && $mejorar_bien == "atencionCliente") echo "checked"?>>
            <label for="atencionCliente">Atención al cliente</label><br>
                <input type="checkbox" name="mejoras[]" value="tiempoEspera" <?php if(isset($mejorar_bien) && $mejorar_bien == "tiempoEspera") echo "checked"?>>
            <label for="tiempoEspera">Tiempo de espera</label><br>
                <input type="checkbox" name="mejoras[]" value="calidadProducto" <?php if(isset($mejorar_bien) && $mejorar_bien == "calidadProducto") echo "checked"?>>
            <label for="calidadProducto">Calidad del producto</label><br>
                <input type="checkbox" name="mejoras[]" value="precio" <?php if(isset($mejorar_bien) && $mejorar_bien == "precio") echo "checked"?>>
            <label for="precio">Precio</label><br>
                <input type="checkbox" name="mejoras[]" value="experienciaWeb" <?php if(isset($mejorar_bien) && $mejorar_bien == "experienciaWeb") echo "checked"?>>
            <label for="experienciaWeb">Experiencia en la web</label><br>
            <?= $errores['mejorar'] ?? '' ?>
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>