<?php
class dbProject {

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


    /**
     * @param $tbl
     * @param $domain_id
     * @param $project_name
     * @param $user_id
     * @param $description
     * @param $date_in
     * @param $date_out
     * @param $date_start_support
     * @param $price
     * @param $date_create
     * @param $create_by
     */
    public function createProject($tbl, $domain_id, $customer_id, $project_name, $user_id, $description, $date_in, $date_out, $date_start_support, $price, $date_create, $create_by)
    {
        $sql = "INSERT INTO " . $tbl . " (
            `domain_id`,
            `customer_id`,
            `project_name`,
            `user_id`,
            `description`,
            `date_in`,
            `date_out`,
            `date_start_support`,
            `price`,
            `date_create`,
            `create_by`
        )
         VALUES (
            :domain_id,
            :customer_id,
            :project_name,
            :user_id,
            :description,
            :date_in,
            :date_out,
            :date_start_support,
            :price,
            :date_create,
            :create_by
        )";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':domain_id', $domain_id);
        $query->bindParam(':customer_id', $customer_id);
        $query->bindParam(':project_name', $project_name);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':description', $description);
        $query->bindParam(':date_in', $date_in);
        $query->bindParam(':date_out', $date_out);
        $query->bindParam(':date_start_support', $date_start_support);
        $query->bindParam(':price', $price);
        $query->bindParam(':date_create', $date_create);
        $query->bindParam(':create_by', $create_by);
        $query->execute();
        $query->rowCount();
    }
    
    public function lastIdInsert()
    {
        $lastId = $this->conn->lastInsertId();
        return $lastId;
    }
    
    public function readAllProject($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function joinUserProject()
    {
        $sql = "SELECT * FROM `users` JOIN `projects` WHERE users.id = projects.user_id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function joinCustomerProject($username)
    {
        $sql = "SELECT * FROM `customers` JOIN `projects` WHERE customers.id = projects.customer_id AND `username`='{$username}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
//    public function checkLoginProject($tbl, $username)
//    {
//        $sql = "SELECT * FROM " . $tbl . " WHERE `username` = '{$username}'";
//        $query = $this->conn->prepare($sql);
//        $query->execute();
//        $result = $query->fetch();
//        return $result;
//    }
    
    public function readProject($sql)
    {
//        $sql = "SELECT * FROM " . $tbl . " WHERE `username` = '{$username}'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function updateProject($tbl, $domain_id, $customer_id, $project_name, $user_id, $description, $date_in, $date_out, $date_start_support, $price,$id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `domain_id`             = :domain_id,
                `customer_id`           = :customer_id,
                `project_name`          = :project_name,
                `user_id`               = :user_id,
                `description`           = :description,
                `date_in`               = :date_in,
                `date_out`              = :date_out,
                `date_start_support`    = :date_start_support,
                `price`                 = :price
                 WHERE `id`             = :id
             ";
        $query = $this->conn->prepare($sql);
//        var_dump($query);exit();
        $query->bindValue(":domain_id", $domain_id);
        $query->bindValue(":customer_id", $customer_id);
        $query->bindValue(":project_name", $project_name);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":description", $description);
        $query->bindValue(":date_in", $date_in);
        $query->bindValue(":date_out", $date_out);
        $query->bindValue(":date_start_support", $date_start_support);
        $query->bindValue(":price", $price);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }
    
    public function deleteProject($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }
}