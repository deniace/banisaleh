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
class MahasiswaFacade {
    //put your code here
    protected $db;
    protected $logger;
    
    public function __construct(ContainerInterface $container) {
        $this->db = $container['db'];
        $this->logger = $container['logger'];
    }
    
    //select all
    public function selectAll(Request $req, Response $res, $args){
        $this->logger->info("application run, select all mahasiswa");
        $db = $this->db;
        $sql = $db->query("SELECT * FROM mahasiswa");
        $list = $sql->fetchAll();
        $res = $res->withJson(ApiResponse::ok("success", $list));
        return $res;
    }

    //select by npm
    public function selectByNpm(Request $req, Response $res, $args){
        $db = $this->db;
        $npm = $args['npm'];
        $this->logger->info("application run, select $npm");
        $sql = $db->prepare("SELECT * FROM mahasiswa WHERE npm = ?");
        $sql->execute([$npm]);
        $data = $sql->fetchObject();
        if($data){
            $res = $res->withJson(ApiResponse::ok("ok", $data));
        } else {
            $res = $res->withJson(ApiResponse::ok("mahasiswa tidak terdaftar", $data));
        }
        return $res;
    }

    public function getPaging(Request $req, Response $res, $args){
        $db = $this->db;
        $data = $req->getParsedBody();
        extract($data);
        // page, page_size
        $offset = ($page * $page_size) - $page_size;
        $query = $db->prepare("SELECT * FROM mahasiswa ORDER BY npm LIMIT ?,?");
        $query_count = $db->prepare("SELECT COUNT(npm) as npm FROM mahasiswa");
        $query_count->execute();
        $data_count = $query_count->fetchObject();

        $query->execute([$offset, $page_size]);
        $data = $query->fetchAll();
        $total_data = $data_count->npm;
        if ($data) {
            $res = $res->withJson(ApiResponse::ok("ok", ["total_data" => $total_data,"rows" => $data]));
        }else {
            $res = $res->withJson(ApiResponse::notFound());
        }
        return $res;
    }
    
    //insert
    public function insert(Request $req, Response $res, $args){
        $data = $req->getParsedBody();
        $this->logger->info("application insert ");
        extract($data);
        $values = array($npm, $nama_mahasiswa, $jenis_kelamin, $jurusan, $no_hp, $email, $agama);
        $db = $this->db;
        try {
            $q = $db->prepare("INSERT INTO mahasiswa VALUES (?,?,?,?,?,?,?)");
            $status = $q->execute($values);
            if($status){
                $res = $res->withJson(ApiResponse::created("save data success", $data));
            } else {
                $res -> $res->withJson(ApiResponse::notAcceptable("save data fail", $data));
            }
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            $res = $res->withJson(ApiResponse::notAcceptable($ex->getMessage));
        }
        return $res;
    }
    
    //update
    public function update(Request $req, Response $res, $args){
        $data = $req->getParsedBody();
        extract($data);
        $values = array($nama_mahasiswa, $jenis_kelamin, $jurusan, $no_hp, $email, $agama, $npm);
        $db = $this->db;
        try {
            $q = $db->prepare("update Mahasiswa set "
                    . "nama_mahasiswa = ?, "
                    . "jenis_kelamin = ?, "
                    . "jurusan = ?, "
                    . "no_hp = ?, "
                    . "email = ?, "
                    . "agama = ? "
                    . "where npm =?");
            $status = $q->execute($values);
            if($status){
                $res = $res->withJson(ApiResponse::created("update data success", $data));
            } else {
                $res = $res->withJson(ApiResponse::notAcceptable("update data fail", $data));
            }
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            $res = $res->withJson(ApiResponse::notAcceptable($ex->getMessage));
        }
        return $res;
    }

    //delete
    public function delete(Request $req, Response $res, $args){
        $npm = $args['npm'];
        $data = ["npm"=>$npm];
        try {
            $q = $this->db->prepare("delete from Mahasiswa where npm = ?");
            $status = $q->execute([$npm]);
            if ($status){
                $res = $res->withJson(ApiResponse::created("delete data success", $data));
            } else {
                $res = $res->withJson(ApiResponse::notAcceptable("delete data fail", $data));
            }
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            $res = $res->withJson(ApiResponse::notAcceptable($ex->getMessage()));
        }
        return $res;
    }
    
    
}
