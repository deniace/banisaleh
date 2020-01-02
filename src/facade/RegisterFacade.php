<?php

namespace Facade;

/**
 * Description of MahasiswaFacade
 *
 * @author Deni Supriyatna
 */

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use Model\ApiResponse as ApiResponse;
use Psr\Container\ContainerInterface as ContainerInterface;

class RegisterFacade {
    //put your code here
    protected $db;
    protected $logger;
    
    public function __construct(ContainerInterface $container) {
        $this->db = $container['db'];
        $this->logger = $container['logger'];
    }
    //iregis
    public function register(Request $req, Response $res, $args){
        $data = $req->getParsedBody();
        $this->logger->info("application register");
        extract($data);
        $values = array($npm, $password);
        $db = $this->db;
        try {
            $q = $db->prepare("INSERT INTO login VALUES (null,?,?)");
            $status = $q->execute($values);
            if($status){
                $res = $res->withJson(ApiResponse::created("Register success", []));
            } else {
                $res -> $res->withJson(ApiResponse::notAcceptable("Register fail", []));
            }
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            $res = $res->withJson(ApiResponse::notAcceptable($ex->getMessage));
        }
        return $res;
    }
}