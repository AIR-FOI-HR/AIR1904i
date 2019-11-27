<?php

require_once './interfaces/ISportDao.php';
require_once './Database.php';

class SportDao implements ISportDao {
    
    public function deleteSports($sports) {
        if (is_null($sports)) { return; }
        
        $sql = "DELETE FROM sports WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($sports as $s) {
            
            if (!($s instanceof Sport)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $s->getId();
            $stmt->execute();
        }
        
        $db->closeConnection();    
        
    }

    public function getAllSports() {
        $sql = "SELECT * FROM sports";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getSportById($sportId) {
        $sql = "SELECT * FROM sports WHERE id=:sportId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':sportId', $sportId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;        
    }

    public function insertSports($sports) {
        $ids = [];
        
        if (is_null($sports)) { return $ids; }
        
        $sql = "INSERT INTO sports("
                . "name, "
                . "description, "
                . "min_players, "
                . "max_players"
                . ") VALUES ("
                . ":name, "
                . ":description, "
                . ":minPlayers, "
                . ":maxPlayers"
                . ")";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':minPlayers', $minPlayers);
        $stmt->bindParam(':maxPlayers', $maxPlayers);
        
        foreach ($sports as $s) {
            
            if (!($s instanceof Sport)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $name = $s->getName();
            $description = $s->getDescription();
            $minPlayers = $s->getMinPlayers();
            $maxPlayers = $s->getMaxPlayers();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateSports($sports) {
        if (is_null($sports)) { return; }
        
        $sql = "UPDATE sports SET "
                . "name=:name, "
                . "description=:description, "
                . "min_players=:minPlayers, "
                . "max_players=:maxPlayers "
                . "WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':minPlayers', $minPlayers);
        $stmt->bindParam(':maxPlayers', $maxPlayers);
        
        foreach ($sports as $s) {
            
            if (!($s instanceof Sport)) { 
                $db->closeConnection();
                return;
            }
            
            $id = $s->getId();
            $name = $s->getName();
            $description = $s->getDescription();
            $minPlayers = $s->getMinPlayers();
            $maxPlayers = $s->getMaxPlayers();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

}