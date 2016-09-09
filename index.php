<?php

require 'vendor/autoload.php';

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],

    'logger' => function() {
        $log = new Monolog\Logger('SLASHER');
        $log->pushHandler(new Monolog\Handler\StreamHandler('php://stderr', Monolog\Logger::WARNING));

        return $log;
    }
];

$slim = new App($config);

$slim->get('/', function(Request $request, Response $response) use ($slim) {
    $requestParams = $request->getParsedBody();
    $slim->getContainer()['logger']->warning($requestParams);

    if(is_array($requestParams)) {
        if(key_exists('user_name', $requestParams))
            $sender = $requestParams['user_name'];

            $tmp = array(
                'response_type' => 'in_channel',
                'text' => "$sender tried to YOLO"
            );

            return $response->withJson($tmp, 200);
    }
});

$slim->run();