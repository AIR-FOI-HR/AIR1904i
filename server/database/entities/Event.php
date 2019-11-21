<?php

class Event {
    private $id;
    private $title;
    private $description;
    private $creationDate;
    private $locationLon;
    private $locationLat;
    private $locationAddr;
    private $startTime;
    private $creatorId;
    private $sportId;
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getLocationLon() {
        return $this->locationLon;
    }

    public function getLocationLat() {
        return $this->locationLat;
    }

    public function getLocationAddr() {
        return $this->locationAddr;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getCreatorId() {
        return $this->creatorId;
    }

    public function getSportId() {
        return $this->sportId;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setCreationDate($creationDate): void {
        $this->creationDate = $creationDate;
    }

    public function setLocationLon($locationLon): void {
        $this->locationLon = $locationLon;
    }

    public function setLocationLat($locationLat): void {
        $this->locationLat = $locationLat;
    }

    public function setLocationAddr($locationAddr): void {
        $this->locationAddr = $locationAddr;
    }

    public function setStartTime($startTime): void {
        $this->startTime = $startTime;
    }

    public function setCreatorId($creatorId): void {
        $this->creatorId = $creatorId;
    }

    public function setSportId($sportId): void {
        $this->sportId = $sportId;
    }
}