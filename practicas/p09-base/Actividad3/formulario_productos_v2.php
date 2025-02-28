<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        ol, ul {
            list-style-type: none;
        }

        .error-message {
            color: red;
        }
    </style>
    <title>Registro de Productos</title>
</head>

<body>
    <h1>Registro de Productos</h1>
    <p>Ingresa los productos nuevos al inventario</p>

    <?php
    // Capturar los valores enviados por POST (si existen)
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $detalles = isset($_POST['detalles']) ? $_POST['detalles'] : '';
    $unidades = isset($_POST['unidades']) ? $_POST['unidades'] : '';
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
    $eliminado = isset($_POST['eliminado']) ? $_POST['eliminado'] : '';
    ?>

    <form id="formularioProductos" action="update_producto.php" method="post">
        <h2>Información del Producto a Registrar</h2>

        <fieldset>
            <legend>Información Del Producto</legend>

            <ul>
                <li>
                    <label for="form-id">Id:</label>
                    <input type="text" name="id" id="form-id" value="<?= htmlspecialchars($id) ?>" required>
                </li><br>
                <li>
                    <label for="form-nombre">Nombre:</label>
                    <input type="text" name="nombre" id="form-nombre" value="<?= htmlspecialchars($nombre) ?>" required>
                    <div id="res1" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-marca">Marca del producto:</label>
                    <select name="marca" id="form-marca" required>
                        <option value="">Seleccione una marca</option>
                        <?php
                        $marcas = ["Rolex", "Omega", "Tag Heuer", "Patek Philippe", "Seiko"];
                        foreach ($marcas as $opcion) {
                            $selected = ($marca == $opcion) ? 'selected' : '';
                            echo "<option value='$opcion' $selected>$opcion</option>";
                        }
                        ?>
                    </select>
                    <div id="res2" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-modelo">Modelo:</label>
                    <input type="text" name="modelo" id="form-modelo" value="<?= htmlspecialchars($modelo) ?>" required>
                    <div id="res3" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-precio">Precio:</label>
                    <input type="number" step="0.01" name="precio" id="form-precio" value="<?= htmlspecialchars($precio) ?>" required>
                    <div id="res4" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-detalles">Detalles:</label>
                    <input type="text" name="detalles" id="form-detalles" value="<?= htmlspecialchars($detalles) ?>" required>
                    <div id="res5" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-unidades">Unidades:</label>
                    <input type="number" name="unidades" id="form-unidades" value="<?= htmlspecialchars($unidades) ?>" required>
                    <div id="res6" class="error-message"></div>
                </li><br>

                <li>
                    <label for="form-img">Imagen-URL:</label>
                    <input type="text" name="imagen" id="form-img" value="<?= htmlspecialchars($imagen) ?>" required>
                    <div id="res7" class="error-message"></div>
                </li><br>
                <li>
                    <label for="form-eliminado">Eliminado:</label>
                    <input type="text" name="eliminado" id="form-eliminado" value="<?= htmlspecialchars($eliminado) ?>" required>
                </li><br>
            </ul>
        </fieldset>

        <p>
            <input type="submit" value="Editar">
            <input type="reset">
        </p>
    </form>

    <script src="./validación.js"></script>
</body>

</html>
