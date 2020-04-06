<?php

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use Model\ApiResponse as ApiResponse;

use Psr\Log\LoggerInterface;
use Slim\Container;

$app->get('/', function (Request $req, Response $res){
    $res->getBody()->write("its work");
    
    return $res;
})
//->setName('root')
;


$app->get('/tesuri', function (Request $req, Response $res){
    $uri = $req->getUri()->getPath();
    $bypass = $this->settings["jwt"]["bypass"];
//    $res->getBody()->write($uri);
    
    $a = array_search($uri, $bypass);
    echo $a;
    return $res;
});

$app->get('/logger-tes', function (Request $req, Response $res, $args){
    /** @var Container $this */
    /** @var LoggerInterface $logger */
    $logger = $this->get(LoggerInterface::class);
    $logger->error('my error message');
    
    $res->getBody()->write("success");
    
    return $res;
});

$app->group("/mahasiswa", function (){
    $this->get("[/]", "Facade\MahasiswaFacade:selectAll");
    $this->get("/{npm}", "Facade\MahasiswaFacade:selectByNpm");
    $this->post("/","Facade\MahasiswaFacade:insert");
    $this->post("/paging","Facade\MahasiswaFacade:getPaging");
    $this->put("/","Facade\MahasiswaFacade:update");
    $this->delete("/{npm}", "Facade\MahasiswaFacade:delete");
});

$app->group("/auth", function (){
    $this->post("/login","Facade\LoginFacade:login");
    $this->post("/register","Facade\RegisterFacade:register");
});