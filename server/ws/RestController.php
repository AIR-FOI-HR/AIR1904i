<?php

require_once __DIR__.'/../database/SportDb.php';
require_once __DIR__.'/RestHandler.php';

class RestController {
    
    private $restHandler;
    private $db;
    
    public function __construct() {
        $this->restHandler = new RestHandler();
        $this->db = SportDb::getInstance();
    }

    public function getData() {
        $request = $this->processRequest();
        
        $data = [];
        switch($request["method"]) {
            case "GET": $data = $this->loadData($request); break;
            case "POST": // Drop through
            case "PUT": $data = $this->insertData($request); break;
            case "DELETE": $data = $this->deleteData($request); break;
            default: $data = ["error" => "Invalid method"];
        }
        
        $packedData = $this->restHandler->packData("application/".$request["format"], $data);
        return $packedData;
    }
    
    private function processRequest() {
        $reqMethod = filter_input(INPUT_SERVER, "REQUEST_METHOD");
        $reqFormat = isset($_REQUEST["format"]) ? $_REQUEST["format"] : "json";
        $reqEntity = $_REQUEST["entity"];
        $reqArgs   = json_decode($_REQUEST["args"]);
        //$reqEntity = filter_input(INPUT_REQUEST, "entity");
        //$reqArgs   = json_decode(filter_input(INPUT_REQUEST, "args"));
        
        $request = [
            "method" => $reqMethod,
            "format" => $reqFormat,
            "entity" => $reqEntity,
            "args"   => $reqArgs
        ];
        return $request;
    }

    private function loadData($request) {
        $data = [];
        
        switch($request["entity"]) {
            case "users": 
                $data = $this->loadUserData($request["args"]);
                break;
            case "events": 
                $this->db->getEventDao();
                break;
            case "sports": 
                $this->db->getSportDao();
                break;
            case "settings": 
                $this->db->getSettingDao();
                break;
            case "applications": 
                $this->db->getApplicationDao();
                break;
            case "participations": 
                $this->db->getParticipationDao();
                break;
            case "chats": 
                $this->db->getChatDao();
                break;
            case "messages": 
                $this->db->getMessageDao();
                break;
            default:
                $data = ["error" => "Entity does not exist"]; 
                break;
        }
        return $data;
    }
    
    private function loadUserData($args) {
        $dao = $this->db->getUserDao();
        
        $data = [];
        if (empty($args)) {
            $data = $dao->getAllUsers();
        } else if (isset($args["id"])) {
            $data = $dao->getUserById($data["id"]);
        } else if (isset($args["email"])) {
            $data = $dao->getUserByEmail($data["email"]);
        } else if (isset($args["username"])) {
            $data = $dao->getUserByUsername($data["username"]);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        return $data;
    }

}
