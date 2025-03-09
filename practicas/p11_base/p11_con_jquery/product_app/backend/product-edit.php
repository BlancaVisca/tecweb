<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'Ocurrió un error al procesar la solicitud.'
);

if (!empty($producto)) {
    $jsonOBJ = json_decode($producto);

    if (isset($jsonOBJ->id)) {
        // Validar si el producto con el mismo nombre, marca y modelo ya existe
        $sql_check = "SELECT * FROM productos WHERE 
                        nombre = '{$jsonOBJ->nombre}' AND 
                        marca = '{$jsonOBJ->marca}' AND 
                        modelo = '{$jsonOBJ->modelo}' AND 
                        eliminado = 0 AND 
                        id != {$jsonOBJ->id}"; // Excluir el producto actual de la validación

        $result_check = $conexion->query($sql_check);

        if ($result_check->num_rows > 0) {
            $data['message'] = "No se pudo editar. Ya existe un producto con el mismo nombre, marca y modelo.";
        } else {
            // Si no existe, proceder a la actualización
            $sql = "SELECT * FROM productos WHERE id = '{$jsonOBJ->id}'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                $conexion->set_charset("utf8");

                $sql_update = "UPDATE productos SET 
                                nombre = '{$jsonOBJ->nombre}', 
                                marca = '{$jsonOBJ->marca}', 
                                modelo = '{$jsonOBJ->modelo}', 
                                precio = {$jsonOBJ->precio}, 
                                detalles = '{$jsonOBJ->detalles}', 
                                unidades = {$jsonOBJ->unidades}, 
                                imagen = '{$jsonOBJ->imagen}' 
                            WHERE id = {$jsonOBJ->id} AND eliminado = 0";

                if ($conexion->query($sql_update)) {
                    $data['status'] = "success";
                    $data['message'] = "Producto actualizado correctamente";
                } else {
                    $data['message'] = "ERROR al actualizar el producto: " . mysqli_error($conexion);
                }
            } else {
                $data['message'] = "El producto con ID {$jsonOBJ->id} no existe o ha sido eliminado.";
            }

            $result->free();
        }

        $result_check->free();
    } else {
        $data['message'] = "El ID del producto es necesario para la actualización.";
    }

    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>
