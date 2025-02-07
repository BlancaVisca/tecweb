<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        require_once __DIR__.'/src/funciones.php';
        if(isset($_GET['numero']))
        {
            ejercicio1($_GET['numero']);
        }
    ?>
     <h2>Ejercicio 2</h2>
     <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
     secuencia compuesta por: impar, par, impar</p>
     <?php
        require_once __DIR__.'/src/funciones.php';
        
            ejercicio2();
        
    ?>
    <h2>Ejercicio 3</h2>
    <p>Programa para encontrara un numero aleatorio multiplo del numero a ingresar</p>
    <?php
        require_once __DIR__.'/src/funciones.php';
        if(isset($_GET['numero']))
        {
            ejercicio3($_GET['numero']);
            //ejercicio31($_GET['numero']);
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Arreglo del abecedario con codigo ASCII</p>
    <?php
        require_once __DIR__.'/src/funciones.php';
        ejercicio4();
    ?>

    <h2>Ejercicio 5 FORMULARIO</h2>
    <form action="http://localhost/tecweb/practicas/p06/index.php"  method="post">
        Edad: <input type="number" name="edad"><br>
        Sexo: <input type="text" name="sexo"><br>
        <input type="submit">
    </form>
    <br>

    <?php
    
    require_once __DIR__ . '/src/funciones.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if (isset($_POST['edad']) && isset($_POST['sexo'])) {
            
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];

            $mensaje = ejercicio5($edad, $sexo);

            echo "<h3>Resultado:</h3>";
            echo "Su edad es: $edad años y su sexo es $sexo.<br>";
            echo "<p>$mensaje</p>";
        }
}
?>

<h2>Ejercicio 6 FORMULARIO</h2>
    <form action="http://localhost/tecweb/practicas/p06/index.php"  method="post">
        Edad: <input type="number" name="matricula"><br>
        Sexo: <input type="text" name="sexo"><br>
        <input type="submit">
    </form>
    <br>

    <?php
    
    require_once __DIR__ . '/src/funciones.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if (isset($_POST['edad']) && isset($_POST['sexo'])) {
            
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];

            $mensaje = ejercicio5($edad, $sexo);

            echo "<h3>Resultado:</h3>";
            echo "Su edad es: $edad años y su sexo es $sexo.<br>";
            echo "<p>$mensaje</p>";
        }
}
?>


<h2>Ejercicio 6 </h2>

<h4>Automoviles registrados</h4>
    <?php
        require_once __DIR__.'/src/funciones.php';
        print_r($vehiculos); 
    ?>

    <h3>Busqueda:</h3>

    <form method="post" action="http://localhost/tecweb/practicas/p06/index.php">
        Matrícula: <input type="text" name="matricula"><br>

        <input type="submit" name="buscar" value="Buscar">
        <input type="submit" name="todos" value="Mostrar todos los vehiculos">
    </form>
    <?php
        require_once __DIR__.'/src/funciones.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["buscar"])) {
                $matricula = $_POST["matricula"];
                mostrarauto($matricula);
            } elseif (isset($_POST["todos"])) {
                mostrarautos();
            }
        }
    ?>

</body>
</html>