<?php

class Sport {
    private $id;
    private $name;
    private $description;
    private $minPlayers;
    private $maxPlayers;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getMinPlayers() {
        return $this->minPlayers;
    }

    public function getMaxPlayers() {
        return $this->maxPlayers;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setMinPlayers($minPlayers): void {
        $this->minPlayers = $minPlayers;
    }

    public function setMaxPlayers($maxPlayers): void {
        $this->maxPlayers = $maxPlayers;
    }
    
    public static function fromObject($obj) {
        $sport = new Sport();
        if (isset($obj->id)) {
            $sport->id = $obj->id;
        }
        if (isset($obj->name)) {
            $sport->name = $obj->name;
        }
        if (isset($obj->description)) {
            $sport->description = $obj->description;
        }
        if (isset($obj->minPlayers)) {
            $sport->minPlayers = $obj->minPlayers;
        }
        if (isset($obj->maxPlayers)) {
            $sport->maxPlayers = $obj->maxPlayers;
        }
        return $sport;
    }

}