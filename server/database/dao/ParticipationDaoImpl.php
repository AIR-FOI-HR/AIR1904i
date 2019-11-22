<?php

require_once './interfaces/ParticipationDao.php';
require_once './Database.php';

class ParticipationDaoImpl implements ParticipationDao {
    
    public function deleteParticipations($participations) {
        if (is_null($participations)) { return; }
        
        $sql = "DELETE FROM participations WHERE event_id=:eventId AND player_id=:playerId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        
        foreach ($participations as $p) {
            
            if (!($p instanceof Participation)) { 
                $db->closeConnection();
                return; 
            }
            
            $playerId = $p->getPlayerId();
            $eventId = $p->getEventId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

    public function getAllParticipations() {
        $sql = "SELECT * FROM participations";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getParticipationsByEvent($eventId) {
        
        $sql = "SELECT * FROM participations WHERE event_id=:eventId";
        
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

    public function getParticipationsByPlayer($playerId) {
        
        $sql = "SELECT * FROM participations WHERE player_id=:playerId";
        
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

    public function insertParticipations($participations) {
        $ids = [];
        
        if (is_null($participations)) { return $ids; }
        
        $sql = "INSERT INTO participations(player_id, event_id, chat_id, join_date)"
                . " VALUES (:playerId, :eventId, :chatId, :joinDate)";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':joinDate', $joinDate);
        
        foreach ($participations as $p) {
            
            if (!($p instanceof Participation)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $playerId = $p->getPlayerId();
            $eventId = $p->getEventId();
            $chatId = $p->getChatId();
            $joinDate = $p->getJoinDate();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateParticipations($participations) {
        if (is_null($participations)) { return; }
        
        $sql = "UPDATE participations SET "
                . "event_id=:eventId, "
                . "player_id=:playerId, "
                . "chat_id=:chatId, "
                . "join_date=:joinDate "
                . "WHERE event_id=:eventId AND player_id=:playerId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':playerId', $playerId);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':joinDate', $joinDate);
        
        foreach ($participations as $p) {
            
            if (!($p instanceof Participation)) { 
                $db->closeConnection();
                return; 
            }
            
            $playerId = $p->getPlayerId();
            $eventId = $p->getEventId();
            $chatId = $p->getChatId();
            $joinDate = $p->getJoinDate();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }
}