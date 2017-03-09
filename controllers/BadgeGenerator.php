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

        $message = [
            'response_type' => 'in_channel',
            'text' => ''
        ];
        
        if($this->container->get('badgeGeneratorToken') === $requestToken) {
            $message['text'] = 'token ok';
        }
        return $response->withJson($message);
    }
}
