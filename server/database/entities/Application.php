<?php

class Application {
    private $playerId;
    private $eventId;
    
    public function getPlayerId() {
        return $this->playerId;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function setPlayerId($playerId): void {
        $this->playerId = $playerId;
    }

    public function setEventId($eventId): void {
        $this->eventId = $eventId;
    }
}