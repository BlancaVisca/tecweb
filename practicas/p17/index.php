<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/tecweb/Practicas/p17");


$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hola Mundo Slim :)");
    return $response;
});


$app->get("/hola[/{nombre}]", function ($request, $response, $args) {
    $response->getBody()->write("Hola, " . $args["nombre"] );
    return $response;
});

$app->post("/pruebapost", function ($request, $response, $args) {
    $resPost=$request->getParsedBody();
    $val1=$resPost["val1"];
    $val2=$resPost["val2"];
    $response->getBody()->write("Valores: ". $val1." ".$val2);
    return $response;
});

$app->get("/testjson", function($request, $response, $args){
    $data[0]["nombre"] = "Sergio";
    $data[0]["apellidos"] = "Rojas Espino";
    $data[1]["nombre"] = "Pedro";
    $data[1]["apellidos"] = "Perez Lopez";
    
    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response;
});

//CON POST
$app->post("/testjson", function($request, $response, $args){
    $reqPost = $request->getParsedBody(); 
    $data[0]["nombre"]= $reqPost["nombre1"];
    $data[0]["apellidos"]= $reqPost["apellidos1"];
    $data[1]["nombre"]= $reqPost["nombre2"];
    $data[1]["apellidos"]= $reqPost["apellidos2"];

    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response; 
});

$app->run();
