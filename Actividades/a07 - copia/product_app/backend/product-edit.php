<?php
require_once __DIR__ . '/myapi2/Controller.php';
require_once __DIR__ . '/myapi2/View.php';

use TECWEB\MYAPI\Controllers\ProductController;
use TECWEB\MYAPI\Views\ProductView;

$jsonOBJ = json_decode(json_encode($_POST)); 
$controller = new ProductController('marketzone');
echo $controller->editProduct($jsonOBJ);
?>
