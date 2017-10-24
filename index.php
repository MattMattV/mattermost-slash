<?php

require 'vendor/autoload.php';

use MV\SlashCommands\Controllers\BadgeGenerator;
use MV\SlashCommands\Controllers\NotSlack;
use MV\SlashCommands\Controllers\Ah;
use MV\SlashCommands\Controllers\Clap;
use MV\SlashCommands\Controllers\Comic;
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
$slim->post('/ah', Ah::class);
$slim->post('/clap', Clap::class);
$slim->post('/comic', Comic::class);

$slim->run();
