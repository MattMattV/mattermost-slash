<?php

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,
    ]
];

$slim = new App($config);

$slim->get('/', function(Request $request, Response $response) {
    print_r($request->getParsedBody());
});

$slim->run();