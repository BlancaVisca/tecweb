<?php

require_once __DIR__ . '/vendor/autoload.php'; 
use TECWEB\MYAPI\UPDATE\Update as Update;  

if (isset($_POST['id'])) {
    $jsonOBJ = json_decode(json_encode($_POST));
    $prodObj = new Update('marketzone');
    $prodObj-> edit($jsonOBJ);
    echo $prodObj->getData();
}

?>