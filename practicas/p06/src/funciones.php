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


$vehiculos = [
    "JHK4821" => [
        "Auto" => [
            "marca" => "Toyota",
            "modelo" => 2024,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Juan Pérez",
            "ciudad" => "Madrid",
            "direccion" => "Avenida Norte 123"
        ]
    ],
    "LMN7392" => [
        "Auto" => [
            "marca" => "Honda",
            "modelo" => 2023,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "María López",
            "ciudad" => "Los Ángeles",
            "direccion" => "Calle Oriente 456"
        ]
    ],
    "RTY2853" => [
        "Auto" => [
            "marca" => "Ford",
            "modelo" => 2022,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Carlos Ramírez",
            "ciudad" => "París",
            "direccion" => "Boulevard Poniente 789"
        ]
    ],
    "XCV6928" => [
        "Auto" => [
            "marca" => "Chevrolet",
            "modelo" => 2021,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Ana Torres",
            "ciudad" => "Roma",
            "direccion" => "Avenida Oriente 321"
        ]
    ],
    "BNM3485" => [
        "Auto" => [
            "marca" => "Nissan",
            "modelo" => 2020,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Luis Fernández",
            "ciudad" => "Berlín",
            "direccion" => "Calle Norte 654"
        ]
    ],
    "QWE9123" => [
        "Auto" => [
            "marca" => "Mazda",
            "modelo" => 2019,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Sofía Gómez",
            "ciudad" => "Tokio",
            "direccion" => "Carrera Poniente 789"
        ]
    ],
    "ZXC5671" => [
        "Auto" => [
            "marca" => "Volkswagen",
            "modelo" => 2018,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Ricardo Mendoza",
            "ciudad" => "Londres",
            "direccion" => "Calle Sur 123"
        ]
    ],
    "VBN6782" => [
        "Auto" => [
            "marca" => "Kia",
            "modelo" => 2017,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Gabriela Vargas",
            "ciudad" => "Sídney",
            "direccion" => "Avenida Oriente 456"
        ]
    ],
    "GHJ1357" => [
        "Auto" => [
            "marca" => "Hyundai",
            "modelo" => 2016,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Fernando Castro",
            "ciudad" => "Nueva York",
            "direccion" => "Boulevard Norte 789"
        ]
    ],
    "TYU5793" => [
        "Auto" => [
            "marca" => "Peugeot",
            "modelo" => 2015,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Valeria Ríos",
            "ciudad" => "Toronto",
            "direccion" => "Calle Sur 321"
        ]
    ],
    "OPO4829" => [
        "Auto" => [
            "marca" => "Renault",
            "modelo" => 2014,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Esteban Salazar",
            "ciudad" => "Buenos Aires",
            "direccion" => "Avenida Poniente 654"
        ]
    ],
    "ASD1359" => [
        "Auto" => [
            "marca" => "Tesla",
            "modelo" => 2013,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Diana Herrera",
            "ciudad" => "Ciudad de México",
            "direccion" => "Carrera Norte 789"
        ]
    ],
    "PLM2946" => [
        "Auto" => [
            "marca" => "Fiat",
            "modelo" => 2012,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Javier Reyes",
            "ciudad" => "Moscú",
            "direccion" => "Boulevard Sur 123"
        ]
    ],
    "ERD4567" => [
        "Auto" => [
            "marca" => "Jeep",
            "modelo" => 2011,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Clara Martínez",
            "ciudad" => "Pekín",
            "direccion" => "Calle Oriente 456"
        ]
    ],
    "YUI9087" => [
        "Auto" => [
            "marca" => "Subaru",
            "modelo" => 2010,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Roberto Chávez",
            "ciudad" => "Dubai",
            "direccion" => "Avenida Poniente 789"
        ]
    ]
];


function mostrarauto($matricula){
    global $vehiculos;
    if (array_key_exists($matricula, $vehiculos)) {
        $auto = $vehiculos[$matricula];
        echo "<h2>Información del Auto</h2>";
        echo "<p>Matrícula: $matricula</p>";
        echo "<p>Marca: " . $auto["Auto"]["marca"] . "</p>";
        echo "<p>Modelo: " . $auto["Auto"]["modelo"] . "</p>";
        echo "<p>Tipo: " . $auto["Auto"]["tipo"] . "</p>";
        echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
        echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
        echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
    } else {
        echo "<p>Matrícula no registrada.</p>";
    }
}

    function mostrarautos() {
        global $vehiculos;
        foreach ($vehiculos as $matricula => $auto) {

            echo "<h2>Auto:</h2>";
            echo "<P>Matrícula: $matricula</P>";
            echo "<p>Marca: " . $auto["Auto"]["marca"] . "</p>";
            echo "<p>Modelo: " . $auto["Auto"]["modelo"] . "</p>";
            echo "<p>Tipo: " . $auto["Auto"]["tipo"] . "</p>";
            echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
            echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
            echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
            
        }
    }

?>


