<?php

require_once __DIR__.'/dao/ApplicationDao.php';
require_once __DIR__.'/dao/ChatDao.php';
require_once __DIR__.'/dao/EventDao.php';
require_once __DIR__.'/dao/MessageDao.php';
require_once __DIR__.'/dao/ParticipationDao.php';
require_once __DIR__.'/dao/SettingDao.php';
require_once __DIR__.'/dao/SportDao.php';
require_once __DIR__.'/dao/UserDao.php';

class SportDb {
    private static $INSTANCE = null;
    
    public static function getInstance() {
        if (SportDb::$INSTANCE == null) {
            SportDb::$INSTANCE = new SportDb();
        }
        return SportDb::$INSTANCE;
    }
    
    private $applicationDao;
    private $chatDao;
    private $eventDao;
    private $messageDao;
    private $participationDao;
    private $settingDao;
    private $sportDao;
    private $userDao;
    
    private function __construct() {
        $this->applicationDao = new ApplicationDao();
        $this->chatDao = new ChatDao;
        $this->eventDao = new EventDao();
        $this->messageDao = new MessageDao();
        $this->participationDao = new ParticipationDao();
        $this->settingDao = new SettingDao();
        $this->sportDao = new SportDao();
        $this->userDao = new UserDao();
    }
    
    public function getApplicationDao() {
        return $this->applicationDao;
    }

    public function getChatDao() {
        return $this->chatDao;
    }

    public function getEventDao() {
        return $this->eventDao;
    }

    public function getMessageDao() {
        return $this->messageDao;
    }

    public function getParticipationDao() {
        return $this->participationDao;
    }

    public function getSettingDao() {
        return $this->settingDao;
    }

    public function getSportDao() {
        return $this->sportDao;
    }

    public function getUserDao() {
        return $this->userDao;
    }

}