<?php

require_once './interfaces/ISettingDao.php';
require_once './Database.php';

class SettingDao implements ISettingDao {
    
    public function deleteSettings($settings) {
        if (is_null($sports)) { return; }
        
        $sql = "DELETE FROM settings WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($settigns as $s) {
            
            if (!($s instanceof Setting)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $s->getId();
            $stmt->execute();
        }
        
        $db->closeConnection(); 
    }

    public function getAllSettings($settings) {
        $sql = "SELECT * FROM settings";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getSettingById($settingId) {
        $sql = "SELECT * FROM settings WHERE id=:settingId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':settingId', $settingId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;        
    }

    public function getSettingsByUser($userId) {
        $sql = "SELECT * FROM settings WHERE user_id=:userId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':userId', $userId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result; 
    }

    public function insertSettings($settings) {
        $ids = [];
        
        if (is_null($settings)) { return $ids; }
        
        $sql = "INSERT INTO settings(`key`, value, user_id) VALUES (:key, :value, :userId)";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':userId', $userId);
        
        foreach ($settings as $s) {
            
            if (!($s instanceof Setting)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $key = $s->getKey();
            $value = $s->getValue();
            $userId = $s->getUserId();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function upadteSettings($settings) {
        if (is_null($settings)) { return; }
        
        $sql = "UPDATE settings SET "
                . "`key`=:key, "
                . "value=:value, "
                . "user_id=:userId "
                . "WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':userId', $userId);
        
        foreach ($settings as $s) {
            
            if (!($s instanceof Setting)) { 
                $db->closeConnection();
                return;
            }
            
            $id = $s->getId();
            $key = $s->getKey();
            $value = $s->getValue();
            $userId = $s->getUserId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();
    }

}