<?php

require_once __DIR__.'/../interfaces/IApplicationDao.php';
require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../entities/Application.php';

class ApplicationDao implements IApplicationDao {
    
    public function deleteApplications($applications) {
        if (is_null($applications)) { return; }
        
        $sql = "DELETE FROM applications WHERE event_id=:eventId AND player_id=:playerId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        
        foreach ($applications as $a) {
            
            if (!($a instanceof Application)) { 
                $a = Application::fromObject($a); 
            }
            
            $playerId = $a->getPlayerId();
            $eventId = $a->getEventId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

    public function getAllApplications() {
        $sql = "SELECT * FROM applications";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getApplicationsByEvent($eventId) {
        
        $sql = "SELECT * FROM applications WHERE event_id=:eventId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':eventId', $eventId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getApplicationsByPlayer($playerId) {
        
        $sql = "SELECT * FROM applications WHERE player_id=:playerId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
        
    }

    public function insertApplications($applications) {
        $ids = [];
        
        if (is_null($applications)) { return $ids; }
        
        $sql = "INSERT INTO applications(player_id, event_id) VALUES (:playerId, :eventId)";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        
        foreach ($applications as $a) {
            
            if (!($a instanceof Application)) { 
                $a = Application::fromObject($a); 
            }
            
            $playerId = $a->getPlayerId();
            $eventId = $a->getEventId();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateApplications($applications) {
        if (is_null($applications)) { return; }
        
        $sql = "UPDATE applications"
                . "SET event_id=:eventId, player_id=:playerId "
                . "WHERE event_id=:eventId AND player_id=:playerId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        
        foreach ($applications as $a) {
            
            if (!($a instanceof Application)) { 
                $a = Application::fromObject($a); 
            }
            
            $playerId = $a->getPlayerId();
            $eventId = $a->getEventId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }
}