<?php

class Setting {
    private $id;
    private $key;
    private $value;
    private $userId;
    
    public function getId() {
        return $this->id;
    }

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setKey($key): void {
        $this->key = $key;
    }

    public function setValue($value): void {
        $this->value = $value;
    }

    public function setUserId($userId): void {
        $this->userId = $userId;
    }
    
    public static function fromObject($obj) {
        $setting = new Setting();
        if (isset($obj->id)) {
            $setting->id = $obj->id;
        }
        if (isset($obj->key)) {
            $setting->key = $obj->key;
        }
        if (isset($obj->value)) {
            $setting->value = $obj->value;
        }
        if (isset($obj->userId)) {
            $setting->userId = $obj->userId;
        }
        return $setting;
    }

}