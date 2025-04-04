<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\READ\Read as Read;  


    $name = $_POST['name'];  
    $prodObj = new Read('marketzone');  
    $prodObj->singleByName($name);  
    echo $prodObj->getData();  

?>