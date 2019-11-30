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
        //var_dump($request); //DEBUG
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
        $reqArgs   = json_decode(base64_decode($_REQUEST["args"]));
        
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
        $fn = null;
        switch($request["entity"]) {
            case "users": 
                $data = $this->loadUserData($request["args"]);
                break;
            case "events": 
                $data = $this->loadEventData($request["args"]);
                break;
            case "sports": 
                $data = $this->loadSportData($request["args"]);
                break;
            case "settings": 
                $data = $this->loadSettingData($request["args"]);
                break;
            case "applications": 
                $data = $this->loadApplicationData($request["args"]);
                break;
            case "participations": 
                $data = $this->loadParticipationData($request["args"]);
                break;
            case "chats": 
                $data = $this->loadChatData($request["args"]);
                break;
            case "messages": 
                $data = $this->loadMessageData($request["args"]);
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
        } else if (isset($args->id)) {
            $data = $dao->getUserById($args->id);
        } else if (isset($args->email)) {
            $data = $dao->getUserByEmail($args->email);
        } else if (isset($args->username)) {
            $data = $dao->getUserByUsername($args->username);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadEventData($args) {
        $dao = $this->db->getEventDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllEvents();
        } else if (isset($args->id)) {
            $data = $dao->getEventById($args->id);
        } else if (isset($args->creatorId)) {
            $data = $dao->getEventsByCreator($args->creatorId);
        } else if (isset($args->sportId)) {
            $data = $dao->getEventsBySport($args->sportId);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadSportData($args) {
        $dao = $this->db->getSportDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllSports();
        } else if (isset($args->id)) {
            $data = $dao->getSportById($args->id);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadSettingData($args) {
        $dao = $this->db->getSettingDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllSettings();
        } else if (isset($args->id)) {
            $data = $dao->getSettingById($args->id);
        } else if (isset($args->userId)) {
            $data = $dao->getSettingsByUser($args->userId);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadApplicationData($args) {
        $dao = $this->db->getApplicationDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllApplications();
        } else if (isset($args->playerId)) {
            $data = $dao->getApplicationsByPlayer($args->playerId);
        } else if (isset($args->eventId)) {
            $data = $dao->getApplicationsByEvent($args->eventId);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadParticipationData($args) {
        $dao = $this->db->getParticipationDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllParticipations();
        } else if (isset($args->playerId)) {
            $data = $dao->getParticipationsByPlayer($args->playerId);
        } else if (isset($args->eventId)) {
            $data = $dao->getParticipationsByEvent($args->eventId);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadChatData($args) {
        $dao = $this->db->getChatDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllChats();
        } else if (isset($args->id)) {
            $data = $dao->getChatById($args->id);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    private function loadMessageData($args) {
        $dao = $this->db->getMessageDao();
        $data = [];
        
        if (empty($args)) {
            $data = $dao->getAllMessages();
        } else if (isset($args->id)) {
            $data = $dao->getMessageById($args->id);
        } else if (isset($args->senderId)) {
            $data = $dao->getMessagesBySender($args->senderId);
        } else if (isset($args->chatId)) {
            $data = $dao->getMessagesByChat($args->chatId);
        } else {
            $data = ["error" => "Invalid arguments"];
        }
        
        return $data;
    }

    
}
