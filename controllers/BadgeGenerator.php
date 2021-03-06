<?php

namespace MV\SlashCommands\Controllers;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class BadgeGenerator
 * @package MV\SlashCommands\Controllers
 */
class BadgeGenerator
{
    /**
     * @var null|Container the current DI container of the Slim app object
     */
    private $container = null;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response)
    {
        $requestToken = $request->getParam('token');
        $requester = $request->getParam('user_name');

        $parameters = explode(' ', urldecode($request->getParam('text')));

        $baseUrl = 'https://img.shields.io/badge/';

        $message = [
            'response_type' => 'in_channel',
            'user_name' => $request->getParam('user_name'),
            'text' => 'wrong token'
        ];

        if (count($parameters) >= 3) {
            $message['text'] = "![Badge from $requester]($baseUrl";

            $link = urlencode($parameters[0])
                ."-"
                .urlencode($parameters[1])
                ."-"
                .urldecode($parameters[2])
                .'.svg';

            if (count($parameters) === 4) {
                $link .= "?style=".urlencode($parameters[3]);
            }

            $message['text'] .= $link . ')';
        } else {
            $message['response_type'] = 'ephemeral';
            $message['text'] = 'Problem with parameters';
        }

        return $response->withJson($message);
    }
}
