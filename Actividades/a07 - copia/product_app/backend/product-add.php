<?php
require_once __DIR__ . '/myapi2/Controller.php';
require_once __DIR__ . '/myapi2/View.php';

use TECWEB\MYAPI\Controllers\ProductController;
use TECWEB\MYAPI\Views\ProductView;

// Recibir datos JSON desde una petición POST
$jsonOBJ = json_decode(json_encode($_POST));  // Aquí convierte $_POST a JSON si es necesario

$controller = new ProductController('marketzone');

// Agregar producto y mostrar respuesta
echo $controller->addProduct($jsonOBJ);
?>
