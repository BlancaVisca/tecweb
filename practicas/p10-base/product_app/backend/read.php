<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();

// SE VERIFICA HABER RECIBIDO EL DATO DE BÚSQUEDA
if (isset($_POST['search'])) {
    $search = $conexion->real_escape_string($_POST['search']); // Escapar caracteres especiales

    // Si la búsqueda es numérica, buscar por id
    if (is_numeric($search)) {
        // Realiza la búsqueda solo por ID
        $query = "SELECT * FROM productos WHERE id = {$search}";
    } else {
        // Si no es numérico, hacer búsqueda por marca, detalles o nombre
        $query = "SELECT * FROM productos WHERE marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%' OR nombre LIKE '%{$search}%'";
    }

    // Se ejecuta la consulta
    if ($result = $conexion->query($query)) {
        // Se recorren los resultados
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;  // Agregar cada fila al arreglo de respuesta
        }
        $result->free();
    } else {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    // Se cierra la conexión
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
