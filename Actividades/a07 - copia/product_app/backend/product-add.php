<?php
require_once __DIR__ . '/myapi2/Controller.php';
require_once __DIR__ . '/myapi2/View.php';

use TECWEB\MYAPI\Controllers\ProductController;
use TECWEB\MYAPI\Views\ProductView;

// Recibir datos JSON desde una petición POST
$jsonOBJ = json_decode(json_encode($_POST));  // Aquí convierte $_POST a JSON si es necesario

// Crear instancia del controlador y agregar el producto
$controller = new ProductController('marketzone');
$response = $controller->addProduct($jsonOBJ);  // Llamamos al controlador para agregar el producto

// Crear instancia de la vista y renderizar la respuesta en formato JSON
$view = new ProductView();
echo json_encode($view->renderJson($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);  // Aquí enviamos el response como JSON
?>
