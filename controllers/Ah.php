<?php

namespace MV\SlashCommands\Controllers;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Ah
 * @package MV\SlashCommands\Controllers
 */
class Ah
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
        $imageUrl = "https://images-cdn.9gag.com/photo/az81PXq_700b.jpg";

        $message = [
            'response_type' => 'in_channel',
            'text' => "![AH]($imageUrl)",
            'user_name' => $request->getParam('user_name')
        ];

        return $response->withJson($message);
    }
}
