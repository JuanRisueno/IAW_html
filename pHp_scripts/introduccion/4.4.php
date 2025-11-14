<!--Ejercicio 4: Pedido de Comida (Select Simple y Radio)
Formulario (HTML):
• Un <select> con name="plato" que contenga 3 opciones (Ej: value="pizza",
value="hamburguesa", value="ensalada").
• Un grupo de radio buttons con name="bebida" (Ej: value="agua", value="refresco").
• Un botón de envío.
Script (PHP):
• Debe recoger el valor de plato y de bebida.
• Debe mostrar un resumen del pedido: "Tu pedido: [Plato] con [Bebida]."-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4.4</title>
</head>
<body>
    <h1>Ejericio 4.4</h1>
    <h2>Pedido de comida</h2>
    <form action="" method="post">
        <p>Plato a elegir 
        <select name="plato" id="plato">
            <option value="" selected disabled>-- Selecciona una opción --</option>
            <option value="pizza">Pizza</option>
            <option value="hamburguesa">Hamburguesa</option>
            <option value="ensalada">Ensalada</option>
        </select></p>
        <p>Bebida a elegir</p>
        <label for="agua">
            <p>Agua <input type="radio" name="bebida" value="agua" checked/>
        </label>
        <label for="refresco">
            Refresco <input type="radio" name="bebida" value="refresco"/>
        </label>
        <label for="cerveza">
            Cerveza <input type="radio" name="bebida" value="cerveza"/></p>
        </label>
        <p><input type="submit" name="enviar"/></p>
    </form>
    <?php
        if(isset($_POST['enviar'])){
            $plato=$_POST['plato'];
            $bebida=$_POST['bebida'];
            if(empty($plato)){
                echo "<p>Tienes que elegir siempre una comida</p>";
            }else{
                echo "<p>Tu pedido: $plato con $bebida";
            }
        }
    ?>
</body>
</html>