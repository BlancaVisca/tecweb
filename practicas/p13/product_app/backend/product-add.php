<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\CREATE\Create as Create;  

 
 $jsonOBJ = json_decode(json_encode($_POST));
 $prodObj = new Create('marketzone');
 $prodObj->add($jsonOBJ);
 echo $prodObj->getData();

?>
