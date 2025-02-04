<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
	<h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    
	<?php
        //AQUI VA MI CÓDIGO PHP
		$a = "ManejadorSQL";
		$b = 'MySQL';
		$c = &$a;

        echo 'Impresión de las variables originales';
		echo "<br>";
		echo "\$a = $a"; 
		echo "<br>";
		echo "\$b = $b";
		echo "<br>";
		echo "\$c = $c";
		echo "<br>";
		echo "<br>";
		$a = "PHP server";
		$b = &$a;

		echo 'Impresión de las variables con modificación';
		echo "<br>";
		echo "\$a = $a";
		echo "<br>";
		echo "\$b = $b";
		echo "<br>";
		echo "\$c = $c";
		echo "<br>";
		echo "<br>";
		echo 'Explicación: Cuando el valor de $a cambia, también se modifica el valor de $c, ya que esta variable guarda la referencia de a, y $b al inicio era una variable independiente, pero al cambiar su valor a la referencia de $a este también se modifica. Quedando las tres variables con el valor que se le proporcione a $a';
		?>

	<h2>Ejercicio 3</h2>
	<p>Muestra el contenido de cada variable inmediatamente después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglo):</p>
		<?php

		$a = "PHP5";
		echo "\$a = ";
		var_dump($a);
		echo "<br><br>";

		$z[] = &$a; 
		echo "\$z = ";
		var_dump($z);
		echo "<br><br>";

		$b = "5a version de PHP";
		echo "\$b = ";
		var_dump($b);
		echo "<br><br>";

		$c = $b * 10; 
		echo "\$c = ";
		var_dump($c);
		echo "<br><br>";
		

		$a .= $b; 
		echo "\$a =";
		var_dump($a);
		echo "<br><br>";

		$b *= $c; 
		echo "\$b = ";
		var_dump($b);
		echo "<br><br>";

		$z[0] = "MySQL"; 
		echo "\$z = ";
		var_dump($z);
		echo "<br><br>";

		?>

		<p>Marca error en la inicialización de $c ya que no reconoce su valor ($b*10) ya que $b es un string y lo reconoce como NULL</p>

<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>