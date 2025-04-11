<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use TECWEB\MYAPI\CREATE\Create as Create;  
use TECWEB\MYAPI\UPDATE\Update as Update;  

$app = AppFactory::create();
$app->setBasePath("/tecweb/Practicas/p17");


// Añadir producto 

$app->post('/productos', function (Request $request, Response $response, $args) {
    $body = $request->getParsedBody();

    $jsonOBJ = json_decode(json_encode($body));

    $prodObj = new Create('marketzone');
    $prodObj->add($jsonOBJ);

    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});


// Actualizar producto 

$app->put('/productos/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    
    $data = $request->getParsedBody();
    $data['id'] = $id; 

    $jsonOBJ = json_decode(json_encode($data));

    $prodObj = new Update('marketzone');
    $prodObj->edit($jsonOBJ);

    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
