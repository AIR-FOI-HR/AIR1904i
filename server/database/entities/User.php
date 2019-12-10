<?php

class User {
    private $id;
    private $email;
    private $phoneNumber;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $registerDate;
    private $activationCode;
    private $profileImg;
    private $address;
    private $lognitude;
    private $latitude;
    
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getRegisterDate() {
        return $this->registerDate;
    }

    public function getActivationCode() {
        return $this->activationCode;
    }

    public function getProfileImg() {
        return $this->profileImg;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getLognitude() {
        return $this->lognitude;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName): void {
        $this->lastName = $lastName;
    }

    public function setBirthDate($birthDate): void {
        $this->birthDate = $birthDate;
    }

    public function setRegisterDate($registerDate): void {
        $this->registerDate = $registerDate;
    }

    public function setActivationCode($activationCode): void {
        $this->activationCode = $activationCode;
    }

    public function setProfileImg($profileImg): void {
        $this->profileImg = $profileImg;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    public function setLognitude($lognitude): void {
        $this->lognitude = $lognitude;
    }

    public function setLatitude($latitude): void {
        $this->latitude = $latitude;
    }
    
    public static function fromObject($obj) {
        $user = new User();
        if (isset($obj->id)) {
            $user->id = $obj->id;
        }
        if (isset($obj->email)) {
            $user->email = $obj->email;
        }
        if (isset($obj->phoneNumber)) {
            $user->phoneNumber = $obj->phoneNumber;
        }
        if (isset($obj->username)) {
            $user->username = $obj->username;
        }
        if (isset($obj->password)) {
            $user->password = $obj->password;
        }
        if (isset($obj->firstName)) {
            $user->firstName = $obj->firstName;
        }
        if (isset($obj->lastName)) {
            $user->lastName = $obj->lastName;
        }
        if (isset($obj->birthDate)) {
            $user->birthDate = $obj->birthDate;
        }
        if (isset($obj->registerDate)) {
            $user->registerDate = $obj->registerDate;
        }
        if (isset($obj->activationCode)) {
            $user->activationCode = $obj->activationCode;
        }
        if (isset($obj->profileImg)) {
            $user->profileImg = $obj->profileImg;
        }
        if (isset($obj->address)) {
            $user->address = $obj->address;
        }
        if (isset($obj->lognitude)) {
            $user->lognitude = $obj->lognitude;
        }
        if (isset($obj->latitude)) {
            $user->latitude = $obj->latitude;
        }
        return $user;
    }

}