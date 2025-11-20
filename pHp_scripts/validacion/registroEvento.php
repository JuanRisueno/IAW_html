<!--Ejercicio 3: Formulario de Registro de Evento
Una empresa está organizando un evento y necesita recopilar información de los asistentes. Crea un
script PHP que maneje un formulario donde los asistentes puedan registrarse. El formulario debe
recoger la siguiente información:
• Nombre Completo: Debe tener entre 5 y 100 caracteres, solo letras y espacios. No puede estar
vacío.
• Correo Electrónico: Debe ser un formato válido. No puede estar vacío.
• Número de Teléfono: Debe ser un número de 10 dígitos. No puede estar vacío.
• Cantidad de Asistentes: Debe ser un número entero entre 1 y 10. No puede estar vacío.
Al enviar el formulario, el script debe sanear y validar los datos, mostrando mensajes de error para los
campos no válidos.
Cuando sean válidos mostrar los datos de la reserva-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
</head>
<body>
    <p><input type="text" placeholder="Nombre Completo"></p>
    <p><input type="email" placeholder="Correo Electrónico"></p>
    <p><input type="text" placeholder="Número de Teléfono"></p>
    <p><input type="number" placeholder="Asistentes" min="1" max="10"></p>
    <p><input type="submit" value="Registrar"></p>
    
</body>
</html>