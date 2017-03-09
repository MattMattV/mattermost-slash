<?php

namespace MV\SlashCommands\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class BadgeGenerator
 * @package MV\SlashCommands\Controllers
 */
class BadgeGenerator
{
    public function __invoke(Request $request, Response $response)
    {
         $message = [
            'response_type' => 'in_channel',
            'goto_location' => 'https://github.com/MattMattV/mattermost-slash/tree/master',
            'text' => '```' . var_export($request->getParsedBody()) . '```'
        ];

        return $response->withJson($message);
    }
}
