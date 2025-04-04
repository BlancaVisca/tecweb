<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\READ\Read as Read;  

$name = $_GET['name'];  
$prodObj = new Read('marketzone');
$prodObj->name($name);
echo $prodObj->getData(); 

?>
