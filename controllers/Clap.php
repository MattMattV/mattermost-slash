<?php

namespace MV\SlashCommands\Controllers;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Clap
 * @package MV\SlashCommands\Controllers
 */
class Clap
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
        $parameter = urldecode($request->getParam('text'));

        $parameter = explode(' ', $parameter);

        $parameter = implode(' :clap: ', $parameter);

        $message = [
            'response_type' => 'in_channel',
            'text' => $parameter,
            'user_name' => $request->getParam('user_name')
        ];

        return $response->withJson($message);
    }
}
