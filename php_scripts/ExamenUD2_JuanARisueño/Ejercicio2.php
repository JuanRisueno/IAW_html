<?php
    session_start();
    require_once 'funciones.php';
    $errores = [];
    $concepto = '';
    $precio = '';

    if(!isset($_SESSION['articulos'])){
        $_SESSION['articulos'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $concepto = trim($_POST['concepto'] ?? '');
        $precio = (filter_var($_POST['precio'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION) ?? '');

        if(isset($_POST['btn_anadir'])){
            if(empty($concepto)){
                $errores['concepto'] = "Tienes que añadir un artículo.";
            }else{
                $conceptoBien = $concepto;
            }

            if(empty($precio)){
                $errores['precio'] = "Tiene que añadir un precio.";
            }elseif (filter_var($precio,FILTER_VALIDATE_FLOAT) === false){
                $errores['precio'] = "Tienes que rellenar el campo como decimal.";
            }elseif ($precio < 0){
                $errores['precio'] = "El precio tiene que ser positivo.";
            }else{
                $precioBien = $precio;
            }

            if(empty($errores)){
                $producto = [
                    'concepto' => $conceptoBien,
                    'precio' => $precioBien
                ];

                array_push($_SESSION['articulos'],$producto);

                $sumaPrecio = calcularTotalPresupuesto ($_SESSION['articulos']);

                $precio = '';
                $concepto = '';
            }

        }elseif (isset($_POST['btn_borrar_ultimo'])){
            $ultimoArray = count($_SESSION['articulos']);
            unset($_SESSION['articulos'][$ultimoArray - 1]);
            $sumaPrecio = calcularTotalPresupuesto ($_SESSION['articulos']);
        }elseif (isset($_POST['btn_borrar_todo'])){
            $_SESSION['articulos'] = [];
            $sumaPrecio = calcularTotalPresupuesto ($_SESSION['articulos']);
        }

        
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen PHP - Presupuesto</title>
    <link rel="stylesheet" href="estilo2.css">
</head>
<body>

    <h1>Generador de Presupuestos</h1>

    <div class="panel">
        <form method="POST" action="">
            <label for="concepto">Concepto:</label>
            <input type="text" id="concepto" name="concepto" placeholder="Ej: Hosting anual" value="<?= htmlspecialchars($concepto ?? '') ?>" >
            <p><?= $errores['concepto'] ?? '' ?></p>

            <label for="precio">Precio (€):</label>
            <input type="text" id="precio" name="precio" placeholder="Ej: 150.50" value="<?= htmlspecialchars($precio ?? '') ?>">
            <p><?= $errores['precio'] ?? '' ?></p>


            <div class="botones">
                <input type="submit" name="btn_anadir" value="Añadir Producto" class="btn-add">
                <input type="submit" name="btn_borrar_ultimo" value="Borrar Último" class="btn-del-last">
                <input type="submit" name="btn_borrar_todo" value="Borrar Presupuesto" class="btn-del-all">
            </div>
        </form>
    </div>

    <div class="panel" style="padding: 0; overflow: hidden;">
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th class="precio-col">Precio (€)</th>
                </tr>
            </thead>
            <tbody>
                <!--Insertar aquí los productos del presupuesto -->
                <!-- He insertado uno de prueba pero este lo debéis borrar-->
                <?php foreach($_SESSION['articulos'] as $c): ?>
                    <tr>
                    <td><?= $c['concepto'] ?></td>
                    <td class="precio-col"><?= $c['precio'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-box">
            <!-- Modificar para que siempre te muestre el precio actualizado -->
            Total: <?php echo $sumaPrecio ?? 0 ?> €
        </div>
    </div>

</body>
</html>