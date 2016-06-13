<?php

class db {

    public $db;
    public $host;
    public $user;
    public $pass;
    protected $conn;

    public function __construct($db, $host, $user, $pass)
    {
        try {
            $dsn = "mysql:host=" . $this->host = $host . ';dbname=' . $this->db = $db . ';charset=utf8';
//            var_dump($dsn);
            $this->conn = new PDO($dsn,$this->user = $user,$this->pass = $pass);
        }catch (Exception $e) {
            echo '<pre class="error_db">' . $e->getMessage() . '</pre>';
        }
    }
    
}