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
}