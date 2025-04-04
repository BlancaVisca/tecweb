
<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\READ\Read as Read;  


    $search = $_GET['search'];  
    $prodObj = new Read('marketzone');  
    $prodObj->search($search);  
    echo $prodObj->getData();  

?>