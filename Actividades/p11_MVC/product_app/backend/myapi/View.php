<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\Modelo as Modelo;
require_once __DIR__ . '/Modelo.php';

//Vistas ->Solo devuelve mensajes

Class View{
    private $data=NULL;

    public function __construct() {
        $this->data = array(
            'status' => 'error',
            'message' => 'Hubo un error al procesar',
            'data'=> [],
        );
    }
    public function getData(){
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        return $jsonData;
    }
    public function ins_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto agregado";
    }
    public function ins_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no agregado";
    }
    public function ins_ine(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto ya existente";
    }
    public function edi_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto editado correctamente";
    }
    public function edi_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no editado";
    }
    public function edi_ine(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no existente";
    }
    public function ext_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no extraido";
    }
    public function eli_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto eliminado correctamente";
    }
    public function eli_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no eliminado";
    }
    public function sear_err(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no encontrado";
    }
    public function list($num,$key,$value){
        $this->data[$num][$key] = utf8_encode($value);
    }
    public function set_data($arr){
        $this->data['data']=$arr;
    }
    public function get_data(){
        return json_encode($this->data['data'], JSON_UNESCAPED_UNICODE);
    }
    
}

?>