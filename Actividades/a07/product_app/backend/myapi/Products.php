<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\DataBase as DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    
    private $data=NULL;
    
    public function __construct( $db, $user='root', $pass='blancaflor') {
        $this->data = array();
        parent:: __construct($user, $pass, $db);
    }


    public function add($jsonOBJ) {

        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows == 0) {

            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                    VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, 
                            '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
    
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto agregado correctamente";
            } else {
                $this->data['status'] = "error";
                $this->data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($this->conexion);
            }
        } else {
            $this->data['status'] = "error";
            $this->data['message'] = "El producto ya existe";
        }
        $result->free();
        $this->conexion->close();
    }
    
    
    

    public function delete($id) {
        if (isset($id)) {
            
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
    
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto eliminado correctamente";
            } else {
                $this->data['status'] = "error";
                $this->data['message'] = "Error en la consulta: " . mysqli_error($this->conexion);
            }
        } else {
            $this->data['status'] = "error";
            $this->data['message'] = "ID no proporcionado";
        }
        $this->conexion->close();
    }
    
    
    public function edit($jsonOBJ) {
        
        $sql = "UPDATE productos SET 
                    nombre='{$jsonOBJ->nombre}', 
                    marca='{$jsonOBJ->marca}', 
                    modelo='{$jsonOBJ->modelo}', 
                    precio={$jsonOBJ->precio}, 
                    detalles='{$jsonOBJ->detalles}', 
                    unidades={$jsonOBJ->unidades}, 
                    imagen='{$jsonOBJ->imagen}' 
                WHERE id={$jsonOBJ->id}";
    
        $this->conexion->set_charset("utf8");

        if ($this->conexion->query($sql)) {

            $this->data['status'] = "success";
            $this->data['message'] = "Producto actualizado";
        } else {

            $this->data['status'] = "error";
            $this->data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($this->conexion);
        }
    
        $this->conexion->close();
    }
    
    

    public function list() {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array();
    
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
    
        $this->conexion->close();
    }
    
    public function search($search){
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			$rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->data[$num][$key] = utf8_encode($value);
                    }
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
		$this->conexion->close();
    } 
    

    

    public function single($id){

        if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $this->data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }


    
    public function singleByName($name){

        if ( $result = $this->conexion->query("SELECT * FROM productos WHERE nombre = '{$name}'") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $this->data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function getData() {

        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
    

}
?>