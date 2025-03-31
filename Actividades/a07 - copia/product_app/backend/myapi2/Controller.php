<?php
namespace TECWEB\MYAPI\Controllers;

use TECWEB\MYAPI\Models\ProductModel;
use TECWEB\MYAPI\Views\ProductView;

require_once __DIR__ . '/Model.php';

class ProductController {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new ProductModel($db);
        $this->view = new ProductView();
    }

 
    public function addProduct($jsonOBJ) {
        $response = $this->model->add($jsonOBJ);

        if ($response) {
            $this->view->ins_exi();
        } else {
            $this->view->ins_fal();
        }
        
        return $this->view->getData();

    }

    public function deleteProduct($id) {
        $response = $this->model->delete($id);
        
        if ($response) {
            $this->view->delete_exitoso();
        } else {
            $this->view->delete_fallido();
        }
        
        return $this->view->getData();

    }

    public function editProduct($jsonOBJ) {
        $response = $this->model->edit($jsonOBJ);
        
        if ($response) {
            $this->view->edi_exi();
        } else {
            $this->view->edi_fal();
        }
        
        return $this->view->getData();

    }

    public function listProduct() {
        $response = $this->model->list();
        $this->view->setData($response);
        return $this->view->getData();
    }
    
}
?>
