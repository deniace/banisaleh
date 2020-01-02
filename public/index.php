<?php
$app = require __DIR__ . '/../config/bootstrap.php';


//require __DIR__.'/../vendor/autoload.php';
//
//$settings = require __DIR__.'/../config/settings.php';
//
//
//require __DIR__.'/../config/dependency.php';
//require __DIR__.'/../config/middleware.php';
//
//$app->get("/", function (Request $req, Response $res, $args){
//    $this->logger->info("Application run");
//    $re = $res->withJson(ApiResponse::ok("Success", ['name'=>"deni", 'jurusan'=>"pulogebang"]));
//    return $re;
//});
//
//$app->get("/sapa", function (Request $req, Response $res, $args){
//    return $req->getBody()->write("walcom");
//    
//});

$app->run();