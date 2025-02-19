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



/** Verificar si el producto ya existe (nombre, modelo y marca), deben coincidir los 3 */
$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo 'El producto ya está registrado con el mismo nombre, modelo y marca.';
} else {
    /** Insertar producto si no existe */
    $sql_insert = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

    if ($link->query($sql_insert)) {
        echo 'Producto insertado con ID: ' . $link->insert_id;
    } else {
        echo 'El Producto no pudo ser insertado =(';
    }
}



$link->close();
?>