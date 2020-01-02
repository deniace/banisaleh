<?php

use Slim\Container;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

$container = $app->getContainer();

// activating routes in subfolder
$container['environment'] = function (){
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

$container['logger'] = function($c){
   $settings = $c->get('settings')['logger'];
   $logger = new Monolog\Logger($settings['name']);
   $logger->pushProcessor(new Monolog\Processor\UidProcessor());
   $logger->pushHandler(new Monolog\Handler\StreamHandler(
           $settings['path'],$settings['level']));
   return $logger;
} ;

$container['db'] = function ($c){
    $settings = $c->get('settings')['db'];
    extract($settings);
    $dsn = "$driver:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $pdo;
};