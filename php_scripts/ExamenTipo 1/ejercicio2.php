<!--Archivo: grimorio.php Objetivo: Gestión de Array en Sesión (Añadir, Borrar, Vaciar).

Instrucciones PHP:

Sesión: Inicia/Crea el array $_SESSION['hechizos'].

Acciones:

Aprender: Añade el hechizo. (Validar: No vacío, No repetido).

Olvidar: Borra el hechizo. (Validar: Que exista).

Quemar Libro: Vacía todo.

Visualización: Muestra la lista siempre.

Sticky Form: Mantén el texto si hay error. Limpia el texto si sale bien.
-->

<?php  
    session_start();
    $errores = [];
    $hechizo = '';

    if(!isset($_SESSION['hechizos'])){
        $_SESSION['hechizos'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $hechizo = trim($_POST['hechizo'] ?? '');
        
        if(isset($_POST['aprender'])){
            if(empty($hechizo)){
                $errores['aprender'] = "Tienes que decirme que hechizo aprender";
            }if(in_array($hechizo,$_SESSION['hechizos'])){
                $errores['aprender'] = "El hechizo ya está aprendido";
            }else{
                array_push($_SESSION['hechizos'],$hechizo);
                $hechizo = '';
            }
        }elseif (isset($_POST['olvidar'])){
            if(empty($hechizo)){
                $errores['olvidar'] = "Tienes que decirme que hechizo olvidar";
            }if(!in_array($hechizo,$_SESSION['hechizos'])){
                $errores['olvidar'] = "El hechizo no está en la lista";
            }else{
                $hechizoOlvidar = array_search($hechizo,$_SESSION['hechizos']);
                unset($_SESSION['hechizos'][$hechizoOlvidar]);
                $hechizo = '';
            }
        }elseif (isset($_POST['quemar'])){
            $_SESSION['hechizos'] = [];
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Grimorio Arcano</title>
    <style>
        body { font-family: monospace; max-width: 500px; margin: 20px auto; background: #2a2a2a; color: #b0b0b0; }
        .panel { background: #333; padding: 20px; border: 2px solid #9932cc; border-radius: 5px; }
        input[type="text"] { width: 70%; padding: 8px; }
        button { padding: 5px 10px; cursor: pointer; margin-top: 10px; }
        .error { color: #ff5555; }
    </style>
</head>
<body>
<div class="panel">
    <h1>📖 Grimorio</h1>
    
    <form action="" method="post">
        <label>Nuevo Hechizo:</label><br>
        <input type="text" name="hechizo" id="hechizo" placeholder="Bola de Fuego..." value="<?= htmlspecialchars($hechizo ?? '') ?>">
        
        <br><br>
        <button type="submit" name="aprender">✨ Aprender</button>
        <button type="submit" name="olvidar">🧠 Olvidar</button>
        <button type="submit" name="quemar">🔥 Quemar Libro</button>
        <p><?= $errores['aprender'] ?? '' ?></p>
        <p><?= $errores['olvidar'] ?? '' ?></p>
    </form>

    <p class="error"></p>

    <h3>Hechizos Conocidos:</h3>

    <?php if((empty($_SESSION['hechizos']) && (empty($errores)))): ?>
        La lista de hechizos está vacía.
    <?php else: ?>
        <ul>
            <?php foreach($_SESSION['hechizos'] as $h): ?>
                <li><?= htmlspecialchars($h) ?></li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
    </div>
</body>
</html>