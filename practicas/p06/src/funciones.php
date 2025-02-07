<?php
function ejercicio1($num)
{
    if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
}

function ejercicio2()
{


    do {
        $a = rand(1, 100);
        $b = rand(1, 100);
        $c = rand(1, 100);
        @$contador++;

        $matriz[] = [$a, $b, $c];

    } while (!($a % 2 != 0 && $b % 2 == 0 && $c % 2 != 0)); 

    
    foreach ($matriz as $fila) {
        echo implode(", ", $fila) . "<br>";
    }

    echo '<h3>'.($contador * 3). ' números obtenidos en '.$contador.' iteraciones';
}

function ejercicio3($num)
{
    $a = rand(1, 100);
    $contador=0;
    while($a%$num!=0)
    {
        $a = rand(1, 100); 
        $contador++;
    }
    echo '<h3>'.'Número encontrado:'.'<h3>'. $a.'<br>';
    echo '<h3>'.'Intentos: '.'<h3>'.$contador.'<br>';
      

}
function ejercicio31($num)
{
    $a = rand(1, 100);
    $contador=0;
    do
    {
        $a = rand(1, 100); 
        $contador++;
    }while($a%$num!=0);
    echo '<h3>'.'Número encontrado:'.'<h3>'. $a.'<br>';
    echo '<h3>'.'Intentos: '.'<h3>'.$contador.'<br>';
      
      

}

function ejercicio4()
{
    $arreglo=array();

    for($i=97;$i<=122;$i++)
    {
        $arreglo[$i] = chr($i);
    }

    echo '<table border="1">';
    echo '<tr><th>ASCII</th><th>Letra</th></tr>';
    
    foreach ($arreglo as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }

    echo '</table>'; 

}

function ejercicio5($edad, $sexo) {


    if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
        return "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        return " No cumple con los requisitos.";
    }
}


?>

