<?php

interface IApplicationDao {
    public function insertApplications($applications);
    public function deleteApplications($applications);
    public function updateApplications($applications);
    public function getAllApplications();
    public function getApplicationsByPlayer($playerId);
    public function getApplicationsByEvent($eventId);
}