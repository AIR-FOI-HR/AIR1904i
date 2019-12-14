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
        var_dump($request); //DEBUG
        $data = [];
        switch($request["method"]) {
            case "GET": $data = $this->loadData($request); break;
            case "POST": $data = $this->postData($request); break;
            case "DELETE": $data = $this->deleteData($request); break;
            default: $data = ["error" => "Invalid method"];
        }
        
        // TODO fix "application/" part
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

    private function postData($request) {
        $data = [];

        switch($request["entity"]) {
            case "users": 
                $data = $this->postUserData($request["args"]);
                break;
            case "events": 
                $data = $this->postEventData($request["args"]);
                break;
            case "sports": 
                $data = $this->postSportData($request["args"]);
                break;
            case "settings": 
                $data = $this->postSettingData($request["args"]);
                break;
            case "applications": 
                $data = $this->postApplicationData($request["args"]);
                break;
            case "participations": 
                $data = $this->postParticipationData($request["args"]);
                break;
            case "chats": 
                $data = $this->postChatData($request["args"]);
                break;
            case "messages": 
                $data = $this->postMessageData($request["args"]);
                break;
            default:
                $data = ["error" => "Entity does not exist"]; 
                break;
        }
        return $data;
    }

    private function postUserData($args) {
        $dao = $this->db->getUserDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "users") == 1) {
                try { $data = $dao->updateUsers($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "users") == 0) {
                try { $data = $dao->insertUsers($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postEventData($args) {
        $dao = $this->db->getEventDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "events") == 1) {
                try { $data = $dao->updateEvents($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "events") == 0) {
                try { $data = $dao->insertEvents($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
        
    }

    private function postSportData($args) {
        $dao = $this->db->getSportDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "sports") == 1) {
                try { $data = $dao->updateSports($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "sports") == 0) {
                try { $data = $dao->insertSports($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postSettingData($args) {
        $dao = $this->db->getSettingDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "settings") == 1) {
                try { $data = $dao->updateSettings($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "settings") == 0) {
                try { $data = $dao->insertSettings($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postApplicationData($args) {
        $dao = $this->db->getApplicationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "applications") == 1) {
                try { $data = $dao->updateApplications($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "applications") == 0) {
                try { $data = $dao->insertApplications($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postParticipationData($args) {
        $dao = $this->db->getParticipationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "participations") == 1) {
                try { $data = $dao->updateParticipations($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "participations") == 0) {
                try { $data = $dao->insertParticipations($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postChatData($args) {
        $dao = $this->db->getChatDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "chats") == 1) {
                try { $data = $dao->updateChats($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "chats") == 0) {
                try { $data = $dao->insertChats($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }

    private function postMessageData($args) {
        $dao = $this->db->getMessageDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($this->entriesExist($args, "messages") == 1) {
                try { $data = $dao->updateMessages($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($this->entriesExist($args, "messages") == 0) {
                try { $data = $dao->insertMessages($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Some entries conflict with those already in database"];
            }
        }
        return $data;
    }
    
    /* returns 1 if all entries exist
     * returns 0 if none of entries exist
     * returns -1 if some entries exist and some do not */
    private function entriesExist($args, $table) {
        // TODO implement check
        return 1;
    }

}
