<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    $error = false;

    // SE VERIFICA HABER RECIBIDO EL NOMBRE
    if (isset($_GET['name'])) {
        $name = $_GET['name'];

        // SE REALIZA LA QUERY DE BÚSQUEDA PARA QUE SOLO COINCIDA CON EL NOMBRE
        $sql = "SELECT * FROM productos WHERE nombre LIKE '{$name}' AND eliminado = 0";

        if ($result = $conexion->query($sql)) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            // Si ya existe un producto con el mismo nombre, se marca un error
            if (count($rows) > 0) {
                $error = true;
            }

            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($conexion));
        }

        $conexion->close();
    }

    // Se devuelve la respuesta con el error si se encuentra un producto con el mismo nombre
    echo json_encode(["error" => $error], JSON_PRETTY_PRINT);
?>
