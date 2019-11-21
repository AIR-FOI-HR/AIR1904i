<?php

require_once './interfaces/ApplicationDao.php';
require_once './Database.php';

class ApplicationDaoImpl implements ApplicationDao {
    
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
                $db->closeConnection();
                return; 
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
        if (is_null($applications)) { return -1; }
        
        $sql = "INSERT INTO applications(player_id, event_id) VALUES (:playerId, :eventId)";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        
        $ids = [];
        
        foreach ($applications as $a) {
            
            if (!($a instanceof Application)) { 
                $db->closeConnection();
                return -1; 
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
                $db->closeConnection();
                return; 
            }
            
            $playerId = $a->getPlayerId();
            $eventId = $a->getEventId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }
}