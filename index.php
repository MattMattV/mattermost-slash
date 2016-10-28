<?php

require 'vendor/autoload.php';

use Slim\App;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$slim = new App($config);

$slim->post('/', function(Request $request, Response $response) use ($slim) {
    $requestParams = $request->getParsedBody();

    if(is_array($requestParams)) {
        $responseArray = [
            'response_type' => 'in_channel',
            'text' => "You should say **Mattermost** not Slack :rage:"
        ];

        return $response->withJson($responseArray, 200);
    }

    $responseArray = [
        'response_type' => 'in_channel',
        'text' => "something went wrong"
    ];

    return $response->withJson($responseArray, 200);

});

$slim->run();
