<?php

use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';


    $id = $_POST['id'];  // Asignar el valor del id
    $prodObj = new Products('marketzone');  // Crear un nuevo objeto de Products
    $prodObj->delete($id);  // Llamar al método de eliminación
    echo $prodObj->getData();  // Mostrar la respuesta de la operación

?>
