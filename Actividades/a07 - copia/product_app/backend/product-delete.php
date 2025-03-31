<?php
require_once __DIR__ . '/myapi2/Controller.php';
require_once __DIR__ . '/myapi2/View.php';

use TECWEB\MYAPI\Controllers\ProductController;
use TECWEB\MYAPI\Views\ProductView;

$id = $_POST['id']; 
$controller = new ProductController('marketzone');
echo $controller->deleteProduct($id);
?>
