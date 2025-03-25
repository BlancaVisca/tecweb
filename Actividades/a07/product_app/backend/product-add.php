<?php

use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';

$prodObj = new Products;

if (isset($_POST['nombre'])) {
    // Convierte $_POST en un objeto PHP
    $Producto = json_decode(json_encode($_POST));

    // Agrega el producto a la base de datos
    $prodObj->addProduct($Producto);

    // Devuelve la respuesta
    echo $prodObj->getResponse();
}
?>
