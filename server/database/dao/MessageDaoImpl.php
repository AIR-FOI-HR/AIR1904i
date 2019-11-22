<?php

require_once './interfaces/MessageDao.php';
require_once './Database.php';

class MessageDaoImpl implements MessageDao {
    
    public function deleteMessages($messages) {
        if (is_null($messages)) { return; }
        
        $sql = "DELETE FROM messages WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($messages as $m) {
            
            if (!($m instanceof Message)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $m->getId();
            $stmt->execute();
        }
        
        $db->closeConnection();    
    }

    public function getAllMessages() {
        $sql = "SELECT * FROM messages";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getMessageById($messageId) {
        $sql = "SELECT * FROM messages WHERE id=:messageId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':messageId', $messageId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;       
    }

    public function getMessagesByChat($chatId) {
        $sql = "SELECT * FROM messages WHERE chat_id=:chatId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':chatId', $chatId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result; 
    }

    public function getMessagesBySender($senderId) {
        $sql = "SELECT * FROM messages WHERE sender_id=:senderId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':senderId', $senderId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result; 
    }

    public function insertMessages($messages) {
        $ids = [];
        
        if (is_null($messages)) { return $ids; }
        
        $sql = "INSERT INTO messages("
                . "send_time, "
                . "text, "
                . "chat_id, "
                . "sender_id"
                . ") VALUES ("
                . ":sendTime, "
                . ":text, "
                . ":chatId, "
                . ":senderId"
                . ")";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':sendTime', $sendTime);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':senderId', $senderId);
        
        foreach ($messages as $m) {
            
            if (!($m instanceof Message)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $sendTime = $m->getSendTime();
            $text = $m->getText();
            $chatId = $m->getChatId();
            $senderId = $m->getSenderId();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateMessages($messages) {
        if (is_null($messages)) { return; }
        
        $sql = "UPDATE messages SET "
                . "send_time=:sendTime, "
                . "text=:text, "
                . "chat_id=:chatId, "
                . "sender_id=:senderId "
                . "WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sendTime', $sendTime);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':senderId', $senderId);
        
        foreach ($messages as $m) {
            
            if (!($m instanceof Message)) { 
                $db->closeConnection();
                return;
            }
            
            $id = $m->getId();
            $sendTime = $m->getSendTime();
            $text = $m->getText();
            $chatId = $m->getChatId();
            $senderId = $m->getSenderId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

}