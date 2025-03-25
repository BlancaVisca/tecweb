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

    public function add($Producto) {

        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $data = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        if (isset($Producto->nombre)) { // Se verifica si el nombre del producto está presente en el objeto
    
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM productos WHERE nombre = '{$Producto->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
    
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                        VALUES ('{$Producto->nombre}', '{$Producto->marca}', '{$Producto->modelo}', {$Producto->precio}, 
                                '{$Producto->detalles}', {$Producto->unidades}, '{$Producto->imagen}', 0)";
                if ($this->conexion->query($sql)) {
                    $data['status'] = "success";
                    $data['message'] = "Producto agregado";
                } else {
                    $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
    
            $result->free();
            // Cierra la conexion
            $this->conexion->close();
        }
    
    }
    

    public function delete($id) {
        // Verificar si se proporcionó un ID
        if (isset($id)) {
            // Ejecutar la consulta SQL para "eliminar" (marcar como eliminado)
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
    
            if ($this->conexion->query($sql)) {
                // Actualizar los valores de $this->data si la consulta fue exitosa
                $this->data['status'] = "success";
                $this->data['message'] = "Producto eliminado correctamente";
            } else {
                // En caso de error en la consulta
                $this->data['status'] = "error";
                $this->data['message'] = "Error en la consulta: " . mysqli_error($this->conexion);
            }
        } else {
            $this->data['status'] = "error";
            $this->data['message'] = "ID no proporcionado";
        }
    
        // Cerrar la conexión
        $this->conexion->close();
    }
    
    
    public function edit(){

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
    

    public function search(){

    }

    public function single(){

    }
    public function singleByName(){

    }

    public function getData() {

        if (empty($this->data)) {
            return json_encode(["status" => "error", "message" => "No data available"], JSON_PRETTY_PRINT);
        }
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
    

}
?>