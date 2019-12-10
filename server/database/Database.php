<?php

class Database {
    private static $INSTANCE = null;
    
    public static function getInstance() {
        if (Database::$INSTANCE == null) {
            Database::$INSTANCE = new Database();
        }
        return Database::$INSTANCE;
    }
    
    private $dbName;
    private $dbDriver;
    private $username;
    private $password;
    private $host;
    private $port;
    private $conn;
    
    private function __construct() {
        $dbSettings = parse_ini_file(".database.ini");
        $this->dbName = $dbSettings["dbname"];
        $this->dbDriver = $dbSettings["driver"];
        $this->username = $dbSettings["user"];
        $this->password = $dbSettings["password"];
        $this->host = $dbSettings["host"];
        $this->port = $dbSettings["port"];
    }
    
    public function getConnection() {
        if ($this->conn == null) {
            $this->conn = new PDO(
                "$this->dbDriver:host=$this->host;port=$this->port;dbname=$this->dbName",
                $this->username,
                $this->password                
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }
    
    public function closeConnection() {
        $this->conn = null;
    }
}
