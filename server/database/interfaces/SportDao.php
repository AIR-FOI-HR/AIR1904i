<?php

interface SportDao {
    public function insertSports($sports);
    public function deleteSports($sports);
    public function updateSports($sports);
    public function getAllSports();
    public function getSportById($sportId);
}