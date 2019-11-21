<?php

interface SettingDao {
    public function insertSettings($settings);
    public function deleteSettings($settings);
    public function upadteSettings($settings);
    public function getAllSettings($settings);
    public function getSettingById($settingId);
    public function getSettingsByUser($userId);
}