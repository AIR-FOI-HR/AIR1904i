<?php

require_once __DIR__.'/../interfaces/IChatDao.php';
require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../entities/Chat.php';

class ChatDao implements IChatDao {
    
    public function deleteChats($chats) {
        if (is_null($chats)) { return; }
        
        $sql = "DELETE FROM chats WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($chats as $c) {
            
            if (!($c instanceof Chat)) { 
                $c = Chat::fromObject($c);
            }
            
            $id = $c->getId();
            $stmt->execute();
        }
        
        $db->closeConnection();  
    }

    public function getAllChats() {
        $sql = "SELECT * FROM chats";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getChatById($chatId) {
        $sql = "SELECT * FROM chats WHERE id=:chatId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':chatId', $chatId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;       
    }

    public function insertChats($chats) {
        $ids = [];
        
        if (is_null($chats)) { return $ids; }
        
        $sql = "INSERT INTO chats(title) VALUES (:title)";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':title', $title);
        
        foreach ($chats as $c) {
            
            if (!($c instanceof Chat)) { 
                $c = Chat::fromObject($c);
            }
            
            $title = $c->getTitle();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateChats($chats) {
        if (is_null($chats)) { return; }
        
        $sql = "UPDATE chats SET title=:title WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        
        foreach ($chats as $c) {
            
            if (!($c instanceof Chat)) { 
                $c = Chat::fromObject($c);
            }
            
            $id = $c->getId();
            $title = $c->getTitle();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

}