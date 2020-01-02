<?php
require_once __DIR__.'/../vendor/autoload.php';

//inisiate the app
$app = new Slim\App(['settings' => require __DIR__.'/../config/settings.php']);

// setup dependency
require __DIR__.'/container.php';
//require __DIR__.'/dependency.php';

// register middleware
require __DIR__.'/middleware.php';

// register routes

require __DIR__.'/routes.php';

return $app;