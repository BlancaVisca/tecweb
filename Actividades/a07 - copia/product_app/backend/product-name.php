<?php

use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';
$name = $_GET['name'];  
$prodObj = new Products('marketzone');
$prodObj->name($name);
echo $prodObj->getData(); 

?>

