<?php

interface ParticipationDao {
    public function insertParticipations($participations);
    public function deleteParticipations($participations);
    public function updateParticipations($participations);
    public function getAllParticipations();
    public function getParticipationsByPlayer($playerId);
    public function getParticipationsByEvent($eventId);
}