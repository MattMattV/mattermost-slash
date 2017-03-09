<?php

namespace MV\SlashCommands\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 09/03/17
 * Time: 12:04
 */
class NotSlack
{
    public function __invoke(Request $request, Response $response)
    {
        $requestParams = $request->getParsedBody();

        if (is_array($requestParams)) {
            $responseArray = [
                'response_type' => 'in_channel',
                'text'          => "You should say **Mattermost** not Slack :rage:"
            ];

            return $response->withJson($responseArray, 200);
        }

        $responseArray = [
            'response_type' => 'in_channel',
            'text'          => "something went wrong"
        ];

        return $response->withJson($responseArray, 200);
    }
}
