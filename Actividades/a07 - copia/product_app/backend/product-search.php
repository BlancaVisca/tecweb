
<?php
require_once __DIR__ . '/myapi2/Model.php';
use TECWEB\MYAPI\Models\ProductModel;

$search = $_GET['search'];
$prodObj = new ProductModel('marketzone');  
$response = $prodObj->search($search);  
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
