<?php

class dbCustomer {

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


    public function createCustomer($tbl, $telegram_id, $name, $email, $phone, $username, $password, $date, $type_project, $note, $company, $connector, $address, $date_create, $create_by)
    {
        $sql = "INSERT INTO " . $tbl . " (
            `telegram_id`,
            `name`,
            `email`,
            `phone`,
            `username`,
            `password`,
            `date`,
            `type_project`,
            `note`,
            `company`,
            `connector`,
            `address`,
            `date_create`,
            `create_by`
        )
         VALUES (
            :telegram_id,
            :name,
            :email,
            :phone,
            :username,
            :password,
            :date,
            :type_project,
            :note,
            :company,
            :connector,
            :address,
            :date_create,
            :create_by
        )";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->bindParam(':telegram_id', $telegram_id);
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':date', $date);
        $query->bindParam(':type_project', $type_project);
        $query->bindParam(':note', $note);
        $query->bindParam(':company', $company);
        $query->bindParam(':connector', $connector);
        $query->bindParam(':address', $address);
        $query->bindParam(':date_create', $date_create);
        $query->bindParam(':create_by', $create_by);
        $query->execute();
        $query->rowCount();
    }
    
    public function readAllCustomer($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function joinProjectCustomer()
    {
        $sql = "SELECT customers.id,projects.project_name,customers.telegram_id,projects.create_by,customers.name,customers.email,customers.phone,projects.customer_id FROM `customers` JOIN `projects` WHERE customers.id = projects.customer_id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function checkLoginCustomer($tbl, $username)
    {
        $sql = "SELECT * FROM " . $tbl . " WHERE `username` = '{$username}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
    
    public function readCustomer($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function updateCustomer($tbl, $telegram_id, $name, $email, $phone, $username, $password,$date,$type_project,$note,$company, $connector, $address,$date_create,$create_by, $id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `telegram_id`         = :telegram_id,
                `name`                = :name,
                `email`               = :email,
                `phone`               = :phone,
                `username`            = :username,
                `password`            = :password,
                `date`                = :date,
                `type_project`        = :type_project,
                `note`                = :note,
                `company`             = :company,
                `connector`           = :connector,
                `address`             = :address,
                `date_create`         = :date_create,
                `create_by`           = :create_by
                 WHERE `id`           = :id
             ";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->bindValue(":telegram_id", $telegram_id);
        $query->bindValue(":name", $name);
        $query->bindValue(":email", $email);
        $query->bindValue(":phone", $phone);
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
        $query->bindValue(":date", $date);
        $query->bindValue(":type_project", $type_project);
        $query->bindValue(":note", $note);
        $query->bindValue(":company", $company);
        $query->bindValue(":connector", $connector);
        $query->bindValue(":address", $address);
        $query->bindValue(":date_create", $date_create);
        $query->bindValue(":create_by", $create_by);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }
    
    public function deleteCustomer($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }
}