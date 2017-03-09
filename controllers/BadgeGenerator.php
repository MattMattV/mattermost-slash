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
            'text' => '```' . (string) $request->getBody() . '```'
        ];

        return $response->withJson($message);
    }
}
