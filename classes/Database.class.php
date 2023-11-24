<?php
class Database extends PDO {
    private $host = '127.0.0.1:8889';
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