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

$app->setBasePath('/tecweb/Actividades/a09/product_app/backend');





//UNION DE ADD CON SEARCH
$app->get('/products', function (Request $request, Response $response, $args) {
    $queryParams = $request->getQueryParams();
    $search = $queryParams['search'] ?? null;  

    $prodObj = new Read('marketzone');

    if ($search) {
        $prodObj->search($search);
    } else {
        $prodObj->list();
    }

    $data = $prodObj->getData();

    $response->getBody()->write($data);
    return $response;
});


//LISTAR
$app->get('/products1', function (Request $request, Response $response, $args) {
    $prodObj = new Read('marketzone');
    $prodObj->list();  
    $data = $prodObj->getData();  
    $response->getBody()->write($data);
    return $response;
});

// BUSCAR
$app->get('/products2', function (Request $request, Response $response, $args) {
    $search = $request->getQueryParams()['search'];

    $prodObj = new Read('marketzone');
    $prodObj->search($search);
    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});
// ELIMINAR
$app->delete('/product', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $prodObj = new Delete('marketzone');
    $prodObj->delete($id);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

//EDITAR
$app->put('/product', function (Request $request, Response $response, $args) {

    $body = $request->getBody()->getContents();
    $jsonOBJ = json_decode($body);

    $prodObj = new Update('marketzone');
    $prodObj->edit($jsonOBJ);
    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});



// AGREGAR PRODUCTO
$app->post('/product', function (Request $request, Response $response, $args) {
    $parsedBody = $request->getParsedBody(); 
    $jsonOBJ = json_decode(json_encode($parsedBody)); 

    $prodObj = new Create('marketzone');
    $prodObj->add($jsonOBJ);

    $data = $prodObj->getData();
    $response->getBody()->write($data);
    return $response;
});


// CONSULTA POR NOMBRE
$app->get('/productos/buscar-nombre', function (Request $request, Response $response, $args) {
    // Obtener el parámetro 'name' desde la query string
    $name = $request->getQueryParams()['name'] ?? null;

    // Instanciar la clase y buscar el producto por nombre
    $prodObj = new Read('marketzone');
    $prodObj->singleByName($name);
    $data = $prodObj->getData();

    // Escribir la respuesta como JSON
    $response->getBody()->write($data);
    return $response;
});

// CONSULTA POR ID
$app->get('/product', function (Request $request, Response $response, $args) {
    // Obtener el parámetro 'name' desde la query string
    $id = $request->getQueryParams()['id'] ?? null;

    // Instanciar la clase y buscar el producto por nombre
    $prodObj = new Read('marketzone');
    $prodObj->single($id);
    $data = $prodObj->getData();

    // Escribir la respuesta como JSON
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
