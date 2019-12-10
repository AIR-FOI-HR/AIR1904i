<?php

class Participation {
    private $joinDate;
    private $playerId;
    private $eventId;
    private $chatId;
    
    public function getJoinDate() {
        return $this->joinDate;
    }

    public function getPlayerId() {
        return $this->playerId;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function getChatId() {
        return $this->chatId;
    }

    public function setJoinDate($joinDate): void {
        $this->joinDate = $joinDate;
    }

    public function setPlayerId($playerId): void {
        $this->playerId = $playerId;
    }

    public function setEventId($eventId): void {
        $this->eventId = $eventId;
    }

    public function setChatId($chatId): void {
        $this->chatId = $chatId;
    }
    
    public static function fromObject($obj) {
        $participation = new Participation();
        if (isset($obj->joinDate)) {
            $participation->joinDate = $obj->joinDate;
        }
        if (isset($obj->playerId)) {
            $participation->playerId = $obj->playerId;
        }
        if (isset($obj->eventId)) {
            $participation->eventId = $obj->eventId;
        }
        if (isset($obj->chatId)) {
            $participation->chatId = $obj->chatId;
        }
        return $participation;
    }

}