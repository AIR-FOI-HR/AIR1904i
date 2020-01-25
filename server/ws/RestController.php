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
            case "GET": $data = ["content" => $this->loadData($request)]; break;
            case "POST": $data = ["content" => $this->postData($request)]; break;
            case "DELETE": $data = ["content" => $this->deleteData($request)]; break;
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
        
        if (isset($_REQUEST["action"])) {
            $reqAction = $_REQUEST["action"];
        } else {
            switch($reqMethod) {
                case "GET": $reqAction="list"; break;
                case "POST": $reqAction="insert"; break;
                case "DELETE": $reqAction="delete"; break;
            }
        }
        
        $reqArgs   = json_decode(base64_decode($_REQUEST["args"]));
        
        $request = [
            "method" => $reqMethod,
            "format" => $reqFormat,
            "entity" => $reqEntity,
            "action" => $reqAction,
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
                $data = $this->postUserData($request["args"], $request["action"]);
                break;
            case "events": 
                $data = $this->postEventData($request["args"], $request["action"]);
                break;
            case "sports": 
                $data = $this->postSportData($request["args"], $request["action"]);
                break;
            case "settings": 
                $data = $this->postSettingData($request["args"], $request["action"]);
                break;
            case "applications": 
                $data = $this->postApplicationData($request["args"], $request["action"]);
                break;
            case "participations": 
                $data = $this->postParticipationData($request["args"], $request["action"]);
                break;
            case "chats": 
                $data = $this->postChatData($request["args"], $request["action"]);
                break;
            case "messages": 
                $data = $this->postMessageData($request["args"], $request["action"]);
                break;
            default:
                $data = ["error" => "Entity does not exist"]; 
                break;
        }
        return $data;
    }

    private function postUserData($args, $action) {
        $dao = $this->db->getUserDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateUsers($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertUsers($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postEventData($args, $action) {
        $dao = $this->db->getEventDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateEvents($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertEvents($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
        
    }

    private function postSportData($args, $action) {
        $dao = $this->db->getSportDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateSports($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertSports($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postSettingData($args, $action) {
        $dao = $this->db->getSettingDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateSettings($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertSettings($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postApplicationData($args, $action) {
        $dao = $this->db->getApplicationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateApplications($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertApplications($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postParticipationData($args, $action) {
        $dao = $this->db->getParticipationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateParticipations($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertParticipations($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postChatData($args, $action) {
        $dao = $this->db->getChatDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateChats($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertChats($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function postMessageData($args, $action) {
        $dao = $this->db->getMessageDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            if ($action == "update") {
                try { $data = $dao->updateMessages($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else if ($action == "insert") {
                try { $data = $dao->insertMessages($args); }
                catch (PDOException $ex) { $data = ["error" => "Invalid arguments"]; }
            } else {
                $data = ["error" => "Invalid action!"];
            }
        }
        return $data;
    }

    private function deleteData($request) {
        $data = [];

        switch($request["entity"]) {
            case "users": 
                $data = $this->deleteUserData($request["args"]);
                break;
            case "events": 
                $data = $this->deleteEventData($request["args"]);
                break;
            case "sports": 
                $data = $this->deleteSportData($request["args"]);
                break;
            case "settings": 
                $data = $this->deleteSettingData($request["args"]);
                break;
            case "applications": 
                $data = $this->deleteApplicationData($request["args"]);
                break;
            case "participations": 
                $data = $this->deleteParticipationData($request["args"]);
                break;
            case "chats": 
                $data = $this->deleteChatData($request["args"]);
                break;
            case "messages": 
                $data = $this->deleteMessageData($request["args"]);
                break;
            default:
                $data = ["error" => "Entity does not exist"]; 
                break;
        }
        return $data;
    }

    public function deleteUserData($args) {
        $dao = $this->db->getUserDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteUsers($args);
        }
        return $data;
    }

    public function deleteEventData($args) {
        $dao = $this->db->getEventDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteEvents($args);
        }
        return $data;
    }

    public function deleteSportData($args) {
        $dao = $this->db->getSportDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteSports($args);
        }
        return $data;
    }

    public function deleteSettingData($args) {
        $dao = $this->db->getSettingDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteSettings($args);
        }
        return $data;
    }

    public function deleteApplicationData($args) {
        $dao = $this->db->getApplicationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteApplications($args);
        }
        return $data;
    }

    public function deleteParticipationData($args) {
        $dao = $this->db->getParticipationDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteParticipations($args);
        }
        return $data;
    }

    public function deleteChatData($args) {
        $dao = $this->db->getChatDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteChats($args);
        }
        return $data;
    }

    public function deleteMessageData($args) {
        $dao = $this->db->getMessageDao();
        $data = [];
        if (empty($args)) {
            $data = ["error" => "Missing arguments"];
        } else {
            $data = $dao->deleteMessages($args);
        }
        return $data;
    }

}
