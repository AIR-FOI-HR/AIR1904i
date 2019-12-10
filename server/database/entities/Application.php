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
    
    public static function fromObject($obj) {
        $application = new Application();
        if (isset($obj->playerId)) {
            $application->playerId = $obj->playerId;
        }
        if (isset($obj->eventId)) {
            $application->eventId = $obj->eventId;
        }
        return $application;
    }
}