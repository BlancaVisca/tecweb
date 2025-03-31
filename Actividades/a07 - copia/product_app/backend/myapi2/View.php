<?php
namespace TECWEB\MYAPI\Views;
 
class ProductView {
    
        private $data=NULL;
    
        public function __construct() {
            $this->data = array(
                'status' => 'error',
                'message' => 'Hubo un error al procesar',
            );
        }
        public function getData(){
            $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
            return $jsonData;
        }
        public function setData($data) {
            $this->data = $data;
        }
        public function ins_exi(){
            $this->data['status'] =  "success";
            $this->data['message'] =  "Producto agregado  :)";
        }
        public function ins_fal(){
            $this->data['status'] =  "error";
            $this->data['message'] =  "Producto no agregado";
        }
        public function delete_exitoso(){
            $this->data['status'] =  "success";
            $this->data['message'] =  "Producto eliminado  :)";
        }
        public function delete_fail(){
            $this->data['status'] =  "error";
            $this->data['message'] =  "No se pudo eliminar el producto";
        }
        public function edi_exi(){
            $this->data['status'] =  "success";
            $this->data['message'] =  "Producto editado correctamente";
        }
        public function edi_fal(){
            $this->data['status'] =  "error";
            $this->data['message'] =  "Producto no editado";
        }

    }
    
?>
