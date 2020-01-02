<?php

namespace Facade;

/*
 * Deni Supriyatna
 */

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use Model\ApiResponse as ApiResponse;
use Psr\Container\ContainerInterface as ContainerInterface;
use Firebase\JWT\JWT as JWT;

class LoginFacade {

    protected $db;
    protected $logger;
    protected $settings;

    public function __construct(ContainerInterface $container) {
        $this->db = $container['db'];
        $this->logger = $container["logger"];
        $this->settings = $container['settings'];
    }

    private function createToken($n) {
        $secretKey = $this->settings["jwt"]["secretkey"];
        $payload = array(
            "iss" => "http://localhost:8080/banisaleh",
            "aud" => "http://localhost:8080/banisaleh",
            "iat" => (int) microtime(TRUE),
            "exp" => (int) microtime(TRUE) + 3600,
            "user" => $n
        );
        $token = JWT::encode($payload, $secretKey);
        return $token;
    }

    public function login(Request $req, Response $res, $args) {
        try {
            $auth = $req->getHeader("Authorization");
            if (count($auth) == 0) {
                return $res->withJson(ApiResponse::unauthorized(
                                        "Please provide your username and password", "invalid login")
                );
            }
            $strCred = base64_decode(str_replace("Basic ", "", $auth[0]));

            $credentials = explode(':', $strCred);
            if ($this->cariDB(strtolower($credentials[0]), strtolower($credentials[1]))) {
       
                $data = array(
//                "username" => $credentials[0],
                "token" => $this->createToken($credentials[0]));
                $res = $res->withJson(ApiResponse::ok("Login succes!", $data));
            } else {
                $res = $res->withJson(ApiResponse::unauthorized("Invalid username or password"));
            }
        } catch (Exception $ex) {
            
        }
        return $res;
    }

    private function cariDB($npm, $password) {
        $ret = FALSE;
        $values = array($npm, $password);
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM login WHERE npm = ? and password =? limit 1");
        $sql->execute($values);
        $data = $sql->fetchObject();
        
        if ($data) {
            $ret = TRUE;
        } else {
            $ret = FALSE;
        }
        return $ret;
    }

}
