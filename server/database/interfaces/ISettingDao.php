<?php

interface ISettingDao {
    public function insertSettings($settings);
    public function deleteSettings($settings);
    public function upadteSettings($settings);
    public function getAllSettings();
    public function getSettingById($settingId);
    public function getSettingsByUser($userId);
}