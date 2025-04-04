<?php
namespace TECWEB\MYAPI\READ;
use TECWEB\MYAPI\DataBase as DataBase;
//require_once __DIR__ . '/DataBase.php';
//require_once __DIR__ . '/../DataBase.php';


class Read extends DataBase {

    public function __construct( $db) {
        $this->data = array();
        parent:: __construct($db);
    }

    public function list() {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        
    
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

    

//FUNCION EXTRA DE VALIDACION DE NOMBRE PARA EL

public function name($name) {

    $name = $this->conexion->real_escape_string($name);

  
    if ($result = $this->conexion->query("SELECT * FROM productos WHERE nombre = '{$name}'")) {
        $row = $result->fetch_assoc();
        
        if (!is_null($row)) {
            $this->data['error'] = true; 
            $this->data['message'] = 'Ya existe un producto con ese nombre'; 
        } else {
            $this->data['error'] = false;  
            $this->data['message'] = 'Nombre válido'; 
        }
        
        $result->free();
    } else {
        $this->data['error'] = true;
        $this->data['message'] = 'Error en la consulta SQL';  

    $this->conexion->close();

}


}
}
?>