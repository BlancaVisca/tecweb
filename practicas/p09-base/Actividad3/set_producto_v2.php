<?php
/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'blancaflor', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}
$nombre   = $_POST['nombre'];
$marca    = $_POST['marca'];
$modelo   = $_POST['modelo'];
$precio   = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen   = $_POST['img'];

if (empty($imagen)) {
    $imagen = "/tecweb/practicas/p07-base/img/imagen.png";  // Ruta predeterminada
}

/** Verificar si el producto ya existe (nombre, modelo y marca), deben coincidir los 3 */
$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo 'El producto ya está registrado con el mismo nombre, modelo y marca.';
} else {
    /** Insertar producto si no existe */
    /**$sql_insert = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
    */

    
    /**INSERTADO CON COLUM NAMES */
    $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                   VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";


    if ($link->query($sql_insert)) {
        
        echo "<h3>Producto insertado con éxito</h3>";
        echo 'Producto insertado con ID: ' . $link->insert_id;
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Marca:</strong> $marca</p>";
        echo "<p><strong>Modelo:</strong> $modelo</p>";
        echo "<p><strong>Precio:</strong> $$precio</p>";
        echo "<p><strong>Detalles:</strong> $detalles</p>";
        echo "<p><strong>Unidades:</strong> $unidades</p>";
        echo "<p><strong>Imagen:</strong> <br><img src='$imagen' alt='Imagen del producto' width='200'></p>";
    } else {
        echo 'El Producto no pudo ser insertado =(';
    }
}



$link->close();
?>