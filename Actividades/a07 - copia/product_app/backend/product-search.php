
<?php

use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';


    $search = $_GET['search'];  
    $prodObj = new Products('marketzone');  
    $prodObj->search($search);  
    echo $prodObj->getData();  

?>