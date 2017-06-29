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
        $imageUrl = "https://pbs.twimg.com/profile_images/805774049892855808/Qw1m1Uvo.jpg";

        $message = [
            'response_type' => 'in_channel',
            'text' => "![AH]($imageUrl)"
        ];

        return $response->withJson($message);
    }
}
