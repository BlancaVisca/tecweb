<?php
namespace TECWEB\MYAPI\Models;
use TECWEB\MYAPI\DataBase;
require_once __DIR__ . '/DataBase.php';

class ProductModel extends DataBase {
    
    public function __construct($db, $user='root', $pass='blancaflor') {
        parent::__construct($user, $pass, $db);
    }

    
    public function add($objeto) {
        $nombre   = mysqli_real_escape_string($this->conexion, $objeto->nombre);
        $marca    = mysqli_real_escape_string($this->conexion, $objeto->marca);
        $modelo   = mysqli_real_escape_string($this->conexion, $objeto->modelo);
        $precio   = floatval($objeto->precio);
        $unidades = intval($objeto->unidades);
        $imagen   = mysqli_real_escape_string($this->conexion, $objeto->imagen);

        $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            return false; // El producto ya existe
        }

        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, imagen, eliminado) 
                VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, {$unidades}, '{$imagen}', 0)";
        
        return $this->conexion->query($sql); // true si fue exitoso, false en caso contrario
    }

    public function delete($id) {
        if (!isset($id)) {
            return false; // ID no proporcionado
        }
    
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
        
        if ($this->conexion->query($sql)) {
            return true; // Eliminación exitosa
        } else {
            return $this->conexion->query($sql); // Error en la eliminación
        }
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
            return true; 
        } else {
            return $this->conexion->query($sql);
        }
    
        
    }
}
?>
