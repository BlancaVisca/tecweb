<?php
namespace TECWEB\MYAPI\Controllers;

use TECWEB\MYAPI\Models\ProductModel;

require_once __DIR__ . '/Model.php';

class ProductController {
    private $model;

    public function __construct($db) {
        $this->model = new ProductModel($db);
    }

    public function addProduct($jsonOBJ) {
        return $this->model->add($jsonOBJ);
    }
}
?>
