<?php

require_once __DIR__.'/../interfaces/IUserDao.php';
require_once __DIR__.'/../Database.php';

class UserDao implements IUserDao {
    
    public function deleteUsers($users) {
        if (is_null($users)) { return; }
        
        $sql = "DELETE FROM users WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        foreach ($users as $u) {
            
            if (!($u instanceof User)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $u->getId();
            
            $stmt->execute();
        }
        
        $db->closeConnection();    
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getUserByEmail($email) {
        
        $sql = "SELECT * FROM users WHERE email=:email";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':email', $email);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;
    }

    public function getUserById($userId) {
        
        $sql = "SELECT * FROM users WHERE id=:userId";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':userId', $userId);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;        
    }

    public function getUserByUsername($username) {
        
        $sql = "SELECT * FROM users WHERE username=:username";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':username', $username);
        
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetch();
        
        $db->closeConnection();
        
        return $result;
    }

    public function insertUsers($users) {
        $ids = [];
        
        if (is_null($users)) { return $ids; }
        
        $sql = "INSERT INTO users("
                . "email, "
                . "phone_number, "
                . "username, "
                . "password, "
                . "first_name, "
                . "last_name, "
                . "birth_date, "
                . "register_date, "
                . "activation_code, "
                . "profile_img, "
                . "address, "
                . "longitude, "
                . "latitude"
                . ") VALUES ("
                . ":email, "
                . ":phoneNumber, "
                . ":username, "
                . ":password, "
                . ":firstName, "
                . ":lastName, "
                . ":birthDate, "
                . ":registerDate, "
                . ":activationCode, "
                . ":profileImg, "
                . ":address, "
                . ":longitude, "
                . ":latitude"
                . ")";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':registerDate', $registerDate);
        $stmt->bindParam(':activationCode', $activationCode);
        $stmt->bindParam(':profileImg', $profileImg);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':latitude', $latitude);
        
        foreach ($users as $u) {
            
            if (!($u instanceof User)) { 
                $db->closeConnection();
                return $ids; 
            }
            
            $email = $u->getEmail();
            $phoneNumber = $u->getPhoneNumber();
            $username = $u->getUsername();
            $password = $u->getPassword();
            $firstName = $u->getFirstName();
            $lastName = $u->getLastName();
            $birthDate = $u->getBirthDate();
            $registerDate = $u->getRegisterDate();
            $activationCode = $u->getActivationCode();
            $profileImg = $u->getProfileImg();
            $address = $u->getAddress();
            $longitude = $u->getLognitude();
            $latitude = $u->getLatitude();
            
            $stmt->execute();
            $ids[] = $conn->lastInsertId();
        }
        
        $db->closeConnection();
        return $ids;
    }

    public function updateUsers($users) {
        if (is_null($users)) { return; }
        
        $sql = "UPDATE users SET "
                . "email=:email, "
                . "phone_number=:phoneNumber, "
                . "username=:username, "
                . "password=:password, "
                . "first_name=:firstName, "
                . "last_name=:lastName, "
                . "birth_date=:birthDate, "
                . "register_date=:registerDate, "
                . "activation_code=:activationCode, "
                . "profile_img=:profileImg, "
                . "address=:address, "
                . "longitude=:longitude, "
                . "latitude=:latitude"
                . " WHERE id=:id";
        
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':birthDate', $birthDate);
        $stmt->bindParam(':registerDate', $registerDate);
        $stmt->bindParam(':activationCode', $activationCode);
        $stmt->bindParam(':profileImg', $profileImg);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':latitude', $latitude);
        
        
        foreach ($users as $u) {
            
            if (!($u instanceof User)) { 
                $db->closeConnection();
                return; 
            }
            
            $id = $u->getId();
            $email = $u->getEmail();
            $phoneNumber = $u->getPhoneNumber();
            $username = $u->getUsername();
            $password = $u->getPassword();
            $firstName = $u->getFirstName();
            $lastName = $u->getLastName();
            $birthDate = $u->getBirthDate();
            $registerDate = $u->getRegisterDate();
            $activationCode = $u->getActivationCode();
            $profileImg = $u->getProfileImg();
            $address = $u->getAddress();
            $longitude = $u->getLognitude();
            $latitude = $u->getLatitude();
            
            $stmt->execute();
        }
        
        $db->closeConnection();        
    }

}