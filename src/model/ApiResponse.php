<?php

/**
 * Description of ApiResponse
 *
 * @author Deni Supriyatna
 */
namespace Model;

class ApiResponse {
    //put your code here
    public $meta;
    public $data;
    
    public function __construct($success, $message, $status, $data) {
        $timestamp = time();
        $this->meta = [
            "success"=>$success, "status"=>$status, "message"=>$message, "timestamp"=>$timestamp];
        $this->data = $data;
    }
    
    public static function ok($message, $data){
        return new ApiResponse(TRUE, $message, 200, $data);
    }
    
    public static function created($message, $data){
        return new ApiResponse(TRUE, $message, 201, $data);
    }
    
    public static function saved($message, $data){
        return new ApiResponse(TRUE, $message, 201, $data);
    }
    
    public static function accepted($message, $data){
        return new ApiResponse(TRUE, $message, 202, $data);
    }
    
    public static function noContent($message, $data){
        return new ApiResponse(TRUE, $message, 204, $data);
    }
    
    public static function found($message, $data){
        return new ApiResponse(TRUE, $message, 302, $data);
    }
    
    public static function badRequest(){
        return new ApiResponse(FALSE, "bad request", 400, []);
    }
    
    public static function unauthorized($data){
        return new ApiResponse(FALSE, "Unauthorized", 401, ["Error"=>$data]);
    }
    
    public static function notFound(){
        return new ApiResponse(FALSE, "Data not Found", 404, []);
    }
    
    public static function methodNotAllowed($message){
        return new ApiResponse(FALSE, "Method Not Allowed", 405, ["Error"=>$message]);
    }
    
    public static function notAcceptable($message){
        return new ApiResponse(FALSE, "Not Acceptable", 406, ["Error"=>$message]);
    }
    
    public static function conflict($message){
        return new ApiResponse(FALSE, "Conflict", 409, ["Error"=>$message]);
    }
    
    public static function internalServerError($message){
        return new ApiResponse(FALSE, "internal server error", 500, ["Error"=>$message]);
    }
    
    public static function notImplemented($message){
        return new ApiResponse(FALSE, "Not Implemented", 501, ["Error"=>$message]);
    }
}
