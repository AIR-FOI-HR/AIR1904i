<?php

interface EventDao {
    public function insertEvents($events);
    public function deleteEvents($events);
    public function updateEvents($events);
    public function getAllEvents();
    public function getEventById($eventId);
}