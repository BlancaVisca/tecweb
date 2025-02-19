<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>

    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>

    <?php
        echo '<h4>Respuesta:</h4>';   
        echo '<ul>
            <li>$_myvar es válida porque inicia con guión bajo.</li>
            <li>$_7var es válida porque inicia con guión bajo.</li>
            <li>myvar es inválida porque no tiene el signo de dólar ($).</li>
            <li>$myvar es válida porque inicia con una letra.</li>
            <li>$var7 es válida porque inicia con una letra.</li>
            <li>$_element1 es válida porque inicia con guión bajo.</li>
            <li>$house*5 es inválida porque el símbolo * no está permitido.</li>
        </ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>

    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo '<p>Impresión de las variables originales:</p>';
        echo '<p>$a = ' . $a . '</p>';
        echo '<p>$b = ' . $b . '</p>';
        echo '<p>$c = ' . $c . '</p>';

        $a = "PHP server";
        $b = &$a;

        echo '<p>Impresión de las variables con modificación:</p>';
        echo '<p>$a = ' . $a . '</p>';
        echo '<p>$b = ' . $b . '</p>';
        echo '<p>$c = ' . $c . '</p>';
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación:</p>

    <?php
        $a = "PHP5";
        echo '<p>$a = ' . var_export($a, true) . '</p>';

        $z[] = &$a;
        echo '<p>$z = ' . var_export($z, true) . '</p>';

        $b = "5a version de PHP";
        echo '<p>$b = ' . var_export($b, true) . '</p>';

        @$c = $b * 10;
        echo '<p>$c = ' . var_export($c, true) . '</p>';

        $a .= $b;
        echo '<p>$a = ' . var_export($a, true) . '</p>';

        @$b *= $c;
        echo '<p>$b = ' . var_export($b, true) . '</p>';

        $z[0] = "MySQL";
        echo '<p>$z = ' . var_export($z, true) . '</p>';
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lectura de las variables usando $GLOBALS:</p>

    <?php
        echo '<p>$a = ' . var_export($GLOBALS['a'], true) . '</p>';
        echo '<p>$z = ' . var_export($GLOBALS['z'], true) . '</p>';
        echo '<p>$b = ' . var_export($GLOBALS['b'], true) . '</p>';
        echo '<p>$c = ' . var_export($GLOBALS['c'], true) . '</p>';
    ?>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>

    <?php
        unset($a, $b, $c);
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo '<p>$a = ' . $a . '</p>';
        echo '<p>$b = ' . $b . '</p>';
        echo '<p>$c = ' . $c . '</p>';
    ?>

    <h2>Ejercicio 6</h2>

    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo '<p>Valores booleanos de las variables:</p>';
        echo '<ul>
            <li>$a = ' . var_export((bool)$a, true) . '</li>
            <li>$b = ' . var_export((bool)$b, true) . '</li>
            <li>$c = ' . var_export($c, true) . '</li>
            <li>$d = ' . var_export($d, true) . '</li>
            <li>$e = ' . var_export($e, true) . '</li>
            <li>$f = ' . var_export($f, true) . '</li>
        </ul>';
    ?>

    <h2>Ejercicio 7</h2>
    <ul>
        <li><strong>Versión de Apache y PHP:</strong> <?php echo htmlentities($_SERVER['SERVER_SOFTWARE']); ?></li>
        <li><strong>Sistema Operativo del Servidor:</strong> <?php echo htmlentities(php_uname()); ?></li>
        <li><strong>Idioma del Navegador (Cliente):</strong> <?php echo htmlentities($_SERVER['HTTP_ACCEPT_LANGUAGE']); ?></li>
    </ul>

    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer">
            <img src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" />
        </a>
    </p>

</body>
</html>
