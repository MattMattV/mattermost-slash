<?php

require 'vendor/autoload.php';

use MV\SlashCommands\Controllers\BadgeGenerator;
use MV\SlashCommands\Controllers\NotSlack;
use Slim\App;

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'badgeGeneratorToken' => getenv('BADGE_GENERATOR_TOKEN')
];

$slim = new App($config);

$slim->post('/notSlack', NotSlack::class);
$slim->post('/badgeGenerator', BadgeGenerator::class);

$slim->run();
