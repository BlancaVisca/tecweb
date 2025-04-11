<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use TECWEB\MYAPI\READ\Read as Read; 
use TECWEB\MYAPI\DELETE\Delete as Delete;
use TECWEB\MYAPI\CREATE\Create as Create; 
use TECWEB\MYAPI\UPDATE\Update as Update;  


$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->setBasePath('/tecweb/practicas/p13/product_app/backend');



$app->get('/hola', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hola Slim está funcionando");
    return $response;
});
//LISTAR
$app->get('/productos/leer', function (Request $request, Response $response, $args) {
    $prodObj = new Read('marketzone');
    $prodObj->list();  
    $data = $prodObj->getData();  
    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response->withHeader('Content-Type', 'application/json');
});

// BUSCAR
$app->get('/productos/buscar', function (Request $request, Response $response, $args) {
    $search = $request->getQueryParams()['search'];

    $prodObj = new Read('marketzone');
    $prodObj->search($search);
    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});
// ELIMINAR
$app->delete('/productos/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $prodObj = new Delete('marketzone');
    $prodObj->delete($id);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

//EDITAR
$app->post('/productos/editar', function (Request $request, Response $response, $args) {

    $parsedBody = $request->getParsedBody();
    $jsonOBJ = json_decode(json_encode($parsedBody));
    $prodObj = new Update('marketzone');
    $prodObj->edit($jsonOBJ);
    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});


// AGREGAR PRODUCTO
$app->post('/productos', function (Request $request, Response $response, $args) {
    $parsedBody = $request->getParsedBody(); 
    $jsonOBJ = json_decode(json_encode($parsedBody)); 

    $prodObj = new Create('marketzone');
    $prodObj->add($jsonOBJ);

    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});


// CONSULTA POR NOMBRE
$app->post('/productos/buscar-nombre', function (Request $request, Response $response, $args) {
    $parsedBody = $request->getParsedBody();
    $name = $parsedBody['name'] ?? null;

    $prodObj = new Read('marketzone');
    $prodObj->singleByName($name);
    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});

//Funcion extra

$app->get('/productos/nombre', function (Request $request, Response $response, $args) {
    $name = $request->getQueryParams()['name']; 

    $prodObj = new Read('marketzone');
    $prodObj->name($name); 

    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});
$app->run();
