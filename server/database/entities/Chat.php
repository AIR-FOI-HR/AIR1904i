<?php

class Chat {
    private $id;
    private $title;
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }
    
    public static function fromObject($obj) {
        $chat = new Chat();
        if (isset($obj->id)) {
            $chat->id = $obj->id;
        }
        if (isset($obj->title)) {
            $chat->title = $obj->title;
        }
        return $chat;
    }
}