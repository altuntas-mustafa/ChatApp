<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';
require __DIR__ . '/../config.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../src/routes/routes.php';

$app->run();
