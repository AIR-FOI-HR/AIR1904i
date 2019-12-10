<?php

class Message {
    private $id;
    private $sendTime;
    private $text;
    private $chatId;
    private $senderId;
    
    public function getId() {
        return $this->id;
    }

    public function getSendTime() {
        return $this->sendTime;
    }

    public function getText() {
        return $this->text;
    }

    public function getChatId() {
        return $this->chatId;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setSendTime($sendTime): void {
        $this->sendTime = $sendTime;
    }

    public function setText($text): void {
        $this->text = $text;
    }

    public function setChatId($chatId): void {
        $this->chatId = $chatId;
    }

    public function setSenderId($senderId): void {
        $this->senderId = $senderId;
    }
    
    public static function fromObject($obj) {
        $message = new Message();
        if (isset($obj->id)) {
            $message->id = $obj->id;
        }
        if (isset($obj->sendTime)) {
            $message->sendTime = $obj->sendTime;
        }
        if (isset($obj->text)) {
            $message->text = $obj->text;
        }
        if (isset($obj->chatId)) {
            $message->chatId = $obj->chatId;
        }
        if (isset($obj->senderId)) {
            $message->senderId = $obj->senderId;
        }
        return $message;
    }

}