<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\READ\Read as Read;  


    $id = $_POST['id'];  
    $prodObj = new Read('marketzone');  
    $prodObj->single($id);  
    echo $prodObj->getData();  

?>