<?php
// Incluye el archivo de conexión a la base de datos
include_once __DIR__.'/database.php';


// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Extraemos los datos del producto recibido
    $nombre   = $jsonOBJ->nombre;
    $marca    = $jsonOBJ->marca;
    $modelo   = $jsonOBJ->modelo;
    $precio   = $jsonOBJ->precio;
    $detalles = $jsonOBJ->detalles;
    $unidades = $jsonOBJ->unidades;
    $imagen   = $jsonOBJ->imagen;

    // ** Insertar producto sin validación de marca, nombre y modelo **
    $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                   VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
 
 if ($link->query($sql_insert)) {
        
    echo "<h3>Producto insertado con éxito</h3>";

} else {
    echo 'El Producto no pudo ser insertado =(';
}
}

// Cerrar la conexión
$link->close();
?>
