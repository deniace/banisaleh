<?php

$settings = [];

$settings['displayErrorDetails']= TRUE;

$settings['determineRouteBeforeAppMiddleware'] = false;

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'dbname' => 'banisaleh',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'flags' => [
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Set default fetch mode
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

$settings['logger'] = [
            'name'=>'banisaleh',
            'path'=>__DIR__.'/../logs/app.log',
            'level'=> \Monolog\Logger::DEBUG
        ];

$settings['jwt'] = [
    'bypass' => ['auth/login','auth/register'],
    'secretkey'=>'deniAce'
];

return $settings;