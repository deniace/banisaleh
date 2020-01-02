<?php

use Slim\Http\Request as Request;
use Model\ApiResponse as ApiResponse;
use Firebase\JWT\JWT as JWT;

$app->add(function(Request $req, $res, $next){
    $bypass = $this->settings["jwt"]["bypass"];
    $secretkey = $this->settings["jwt"]["secretkey"];

    $uri = $req->getUri()->getPath();
    if(array_search($uri, $bypass) > -1){
        return $next($req, $res);
    }
    
    $auth = $req->getHeader("Authorization");
    if(count($auth) == 0){
        return $res->withJson(ApiResponse::unauthorized("token not found!"));
    }
    
    $token = $auth[0];
    if(strpos($token, "Bearer ") === FALSE){
        return $res->withJson(ApiResponse::unauthorized("Invalid Token"));
    }
    $tokenClean = str_replace("Bearer ", "", $token);
    
    try{
        if(JWT::decode($tokenClean, $secretkey,["HS256"])){
            return $next($req, $res);
        }else {
            return $res->withJson(ApiResponse::unauthorized("Invalid token"));
        }
    }catch (UnexpectedValueException $ex){
        return $res->withJson(ApiResponse::unauthorized($ex->getMessage()));
    } catch (Firebase\JWT\SignatureInvalidException $ex){
        return $res->withJson(ApiResponse::unauthorized($ex->getMessage()));
    } catch (Firebase\JWT\BeforeValidException $ex){
        return $res->withJson(ApiResponse::unauthorized($ex->getMessage()));
    } catch (Firebase\JWT\ExpiredException $ex){
        return $res->withJson(ApiResponse::unauthorized($ex->getMessage()));
    } catch (Exception $ex){
        return $res->withJson(ApiResponse::unauthorized($ex->getMessage()));
    }
});
