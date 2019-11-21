<?php

class Sport {
    private $id;
    private $name;
    private $desctiption;
    private $minPlayers;
    private $maxPlayers;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDesctiption() {
        return $this->desctiption;
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

    public function setDesctiption($desctiption): void {
        $this->desctiption = $desctiption;
    }

    public function setMinPlayers($minPlayers): void {
        $this->minPlayers = $minPlayers;
    }

    public function setMaxPlayers($maxPlayers): void {
        $this->maxPlayers = $maxPlayers;
    }
}