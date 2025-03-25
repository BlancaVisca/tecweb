<?php
use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';

$prodObj = new TECWEB\MYAPI\Products('marketzone');

// Verificar que los datos llegaron correctamente
if (isset($_POST['postData'])) {
    // Convertir los datos POST a un objeto PHP
    $Producto = (object)$_POST['postData'];
    $prodObj->add($Producto);
    echo $prodObj->getData();  // Devolver la respuesta
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos no válidos']);
}
?>
