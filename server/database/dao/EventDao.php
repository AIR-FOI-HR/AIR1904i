<?php

require_once './interfaces/IEventDao.php';
require_once './Database.php';

class EventDao implements IEventDao {
    
    public function deleteEvents($events) {
        if (is_null($events)) { return; }
        
        $sql = "DELETE FROM events WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($events as $e) {
            
            if (!($e instanceof Event)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $e->getId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();    
    }

    public function getAllEvents() {
        $sql = "SELECT * FROM events";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getEventById($eventId) {
        $sql = "SELECT * FROM events WHERE id=:eventId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':eventId', $eventId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;        
    }
    
    public function getEventsByCreator($creatorId) {
        $sql = "SELECT * FROM events WHERE creator_id=:creatorId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':creatorId', $creatorId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;  
    }

    public function getEventsBySport($sportId) {
        $sql = "SELECT * FROM events WHERE sport_id=:sportId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':sportId', $sportId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result; 
    }

    public function insertEvents($events) {
        $ids = [];
        
        if (is_null($events)) { return $ids; }
        
        $sql = "INSERT INTO events("
                . "title, "
                . "description, "
                . "creation_date, "
                . "location_lon, "
                . "location_lat, "
                . "location_addr, "
                . "start_time, "
                . "creator_id, "
                . "sport_id"
                . ") VALUES ("
                . ":title, "
                . ":description, "
                . ":creationDate, "
                . ":locationLon, "
                . ":locationLat, "
                . ":locationAddr, "
                . ":startTime, "
                . ":creatorId, "
                . ":sportId"
                . ")";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':creationDate', $creationDate);
        $stmt->bindParam(':locationLon', $locationLon);
        $stmt->bindParam(':locationLat', $locationLat);
        $stmt->bindParam(':locationAddr', $locationAddr);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':creatorId', $creatorId);
        $stmt->bindParam(':sportId', $sportId);
        
        foreach ($events as $e) {
            
            if (!($e instanceof Event)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $title = $e->getTitle();
            $description = $e->getDescription();
            $creationDate = $e->getCreationDate();
            $locationLon = $e->getLocationLon();
            $locationLat = $e->getLocationLat();
            $locationAddr = $e->getLocationAddr();
            $startTime = $e->getStartTime();
            $creatorId = $e->getCreatorId();
            $sportId = $e->getSportId();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateEvents($events) {
        if (is_null($events)) { return; }
        
        $sql = "UPDATE events SET "
                . "title=:title, "
                . "description=:description, "
                . "creation_date=:creationDate, "
                . "location_lon=:locationLon, "
                . "location_lat=:locationLat, "
                . "location_addr=:locationAddr, "
                . "start_time=:startTime, "
                . "creator_id=:creatorId, "
                . "sport_id=:sportId"
                . " WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':creationDate', $creationDate);
        $stmt->bindParam(':locationLon', $locationLon);
        $stmt->bindParam(':locationLat', $locationLat);
        $stmt->bindParam(':locationAddr', $locationAddr);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':creatorId', $creatorId);
        $stmt->bindParam(':sportId', $sportId);
        
        
        foreach ($events as $e) {
            
            if (!($e instanceof Event)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $e->getId();
            $title = $e->getTitle();
            $description = $e->getDescription();
            $creationDate = $e->getCreationDate();
            $locationLon = $e->getLocationLon();
            $locationLat = $e->getLocationLat();
            $locationAddr = $e->getLocationAddr();
            $startTime = $e->getStartTime();
            $creatorId = $e->getCreatorId();
            $sportId = $e->getSportId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }
}