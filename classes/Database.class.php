<?php
class Database extends PDO {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';    
    private $dbname = 'fpview';
        //
    public function __construct() {
        $dbh = "mysql:host=$this->host;dbname=$this->dbname";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            parent::__construct($dbh, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Erreur de connexion: " . $e->getMessage());
        }
    }
}