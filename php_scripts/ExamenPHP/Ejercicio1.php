<?php
    require_once 'funciones.php';
    $errores = [];
    $matricula = '';
    $anio = '';
    $marca = '';
    $marcas = ['toyota','ford','bmw'];
    $equipamiento = [];
    $equipamientos = ['techo','navegador','asientos'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $matricula = trim($_POST['matricula'] ?? '');
        $anio = (filter_var($_POST['anio'],FILTER_SANITIZE_NUMBER_INT) ?? '');
        $marca = $_POST['marca'] ?? '';
        $equipamiento = $_POST['equipamiento'] ?? [];

        $matriculaAntigua = 0;
        if(empty($matricula)){
            $errores['matricula'] = "Tienes que rellenar el campo matrícula";
        }elseif((!preg_match("/^\d{4}-?[a-zA-Z]{3}$/",$matricula) && (!preg_match("/^[a-zA-Z]{1,2}-?\d{4}-?[a-zA-Z]{2}$/",$matricula)))){
            $errores['matricula'] = "Tienes que rellenar la matrícula con el formato válido";
        }else{
            $matriculaBien = $matricula;
            if(preg_match("/^[a-zA-Z]{1,2}-?\d{4}-?[a-zA-Z]{2}$/",$matricula)){
                $matriculaAntigua = 1;
            }
        }

        $anioActual = date('Y');
        if(empty($anio)){
            $errores['anio'] = "Tienes que añadir un año";
        }elseif(!preg_match("/^\d{4}$/",$anio)){
            $errores['anio'] = "El año tiene que ser un número de 4 cifras.";
        }elseif(($anio < 1970) || $anio > $anioActual){
            $errores['anio'] = "El año tiene que estar entre 1970 y el año actual";
        }else{
            $anioBien = $anio;
        }

        if(empty($marca)){
            $errores['marca'] = "Tiene que seleccionar una marca";
        }elseif(!in_array($marca,$marcas)){
            $errores['marca'] = "La marca tienes que elegirla de una de la lista";
        }else{
            $marcaBien = $marca;
        }

        if(!empty($equipamiento)){
            if(!empty(array_diff($equipamiento,$equipamientos))){
                $errores['equipamiento'] = "Coge los equipamientos de la lista";
            }elseif(count($equipamiento) > 2){
                $errores['equipamiento'] = "Máximo 2 equipamientos";
            }
        }

        if(empty($errores)){
            $precioTotal = tasarCoche($marcaBien,$anioBien,count($equipamiento),$matriculaAntigua);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen PHP - Tasación de Vehículos</title>
    <link rel="stylesheet" href="estilo1.css">
</head>
<body>
    <div class="container">
        <h1>Tasación de Vehículos Usados</h1>
        
            <div class="resultado">
                Precio de tasación sugerido: <?= $precioTotal ?? 0 ?> €
            </div>

        <form method="POST" action="">
            
            <label for="matricula" class="titulo">Matrícula</label>
            <input type="text" id="matricula" name="matricula" placeholder="Ej: 1234BBB o M-1234-AX" value="<?= htmlspecialchars($matriculaBien ?? '') ?>" >
            <p class="error"><?= $errores['matricula'] ?? '' ?></p>

            <label for="anio" class="titulo">Año de Matriculación</label>
            <input type="text" id="anio" name="anio" placeholder="Entre 1970 y el año actual" value="<?= htmlspecialchars($anioBien ?? '') ?>" >
            <p class="error"><?= $errores['anio'] ?? '' ?></p>

            
            <label for="marca"  class="titulo">Marca</label>
            <select id="marca" name="marca">
                <option value="">-- Selecciona una marca --</option>
                <option value="toyota" <?php if($marca == 'toyota') echo 'selected'?> >Toyota</option>
                <option value="ford" <?php if($marca == 'ford') echo 'selected'?> >Ford</option>
                <option value="bmw" <?php if($marca == 'bmw') echo 'selected'?> >BMW</option>
            </select>
            <p class="error"><?= $errores['marca'] ?? '' ?></p>


            <label class="titulo">Equipamiento Extra (Máximo 2)</label>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="equipamiento[]" value="techo" <?php if(in_array('techo',$equipamiento)) echo 'checked'?> > 
                    Techo Solar
                </label>
                <label>
                    <input type="checkbox" name="equipamiento[]" value="navegador" <?php if(in_array('navegador',$equipamiento)) echo 'checked'?> > 
                    Navegador
                </label>
                <label>
                    <input type="checkbox" name="equipamiento[]" value="asientos" <?php if(in_array('asientos',$equipamiento)) echo 'checked'?> > 
                    Asientos de cuero
                </label>
                <p class="error"><?= $errores['equipamiento'] ?? '' ?></p>

            </div>
            
            <input type="submit" name="btn_tasar" value="Calcular Tasación">
        </form>
    </div>

</body>
</html>