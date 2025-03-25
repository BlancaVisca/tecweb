<?php

use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';

// Usar $_GET en lugar de $_POST para que funcione con la llamada AJAX del JavaScript
$name = $_GET['name'];  // Cambié $_POST por $_GET

// Crear el objeto de productos
$prodObj = new Products('marketzone');

// Llamar al método singleByName para verificar si el nombre ya existe
$prodObj->name($name);

// Devolver los datos en formato JSON para la validación en JavaScript
echo $prodObj->getData(); 

?>
