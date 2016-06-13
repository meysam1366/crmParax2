<?php
class dbUser {

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


    public function createUser($tbl, $name, $email, $username, $password, $post, $idNumber, $role)
    {
        $sql = "INSERT INTO " . $tbl . " (`name`,
        `email`, `username`, `password`,`post`, `idNumber`, `role`)
         VALUES 
         (:name,:email,:username,:password,:post,:idNumber,:role)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':post', $post);
        $query->bindParam(':idNumber', $idNumber);
        $query->bindParam(':role', $role);
        $query->execute();
        $query->rowCount();
    }
    
    public function readAllUser($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function checkLogin($tbl, $username)
    {
        $sql = "SELECT * FROM " . $tbl . " WHERE `username` = '{$username}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
    
    public function readUser($sql)
    {
//        $sql = "SELECT * FROM " . $tbl . " WHERE `username` = '{$username}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function updateUser($tbl, $name, $email, $username, $password,$post, $idNumber, $role, $id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `name`     = :name,
                `email`    = :email,
                `username` = :username,
                `password` = :password,
                `post`     = :post,
                `idNumber` = :idNumber,
                `role`     = :role 
                 WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":name", $name);
        $query->bindValue(":email", $email);
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
        $query->bindValue(":post", $post);
        $query->bindValue(":idNumber", $idNumber);
        $query->bindValue(":role", $role);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }
    
    public function deleteUser($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }

    public function searchUser($field)
    {
        $sql = "SELECT * FROM `users` WHERE `name` LIKE :field";
        $param = array(':field' => '%'.$field.'%');
        $query = $this->conn->prepare($sql);
        $query->execute($param);
//        var_dump($sql);exit();
        $result = $query->fetchObject();
        return $result;
    }
}