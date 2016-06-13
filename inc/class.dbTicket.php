<?php
class dbTicket {

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
     * @param $user_id
     * @param $progress
     * @param $title
     * @param $description
     * @param $file
     * @param $date_start
     * @param $date_end
     * @param $status
     * @param $project_id
     */
    public function createTicket($tbl, $user_id, $progress, $title, $description, $file, $date_start, $date_end, $status,$project_id)
    {
        $sql = "INSERT INTO " . $tbl . " (
            `user_id`,
            `progress`,
            `title`,
            `description`,
            `file`,
            `date_start`,
            `date_end`,
            `status`
        )
         VALUES (
            :user_id,
            :progress,
            :title,
            :description,
            :file,
            :date_start,
            :date_end,
            :status
        )";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':progress', $progress);
        $query->bindParam(':title', $title);
        $query->bindParam(':description', $description);
        $query->bindParam(':file', $file);
        $query->bindParam(':date_start', $date_start);
        $query->bindParam(':date_end', $date_end);
        $query->bindParam(':status', $status);
        $query->execute();
        $query->rowCount();

        $lastId = $this->conn->lastInsertId();
        $s = "INSERT INTO `ticket_project` (
            `project_id`,
            `ticket_id`
        )
        VALUES (
            :project_id,
            :ticket_id
        )";
//        var_dump($s);exit();
        $q = $this->conn->prepare($s);
        $q->bindParam(':project_id', $project_id);
        $q->bindParam(':ticket_id', $lastId);
        $q->execute();
        $q->rowCount();
        
    }
    
    public function lastInsertId($tbl2)
    {
        $project_id = 25;
        $lastId = $this->conn->lastInsertId();
//        echo $project_id . ' ' . $lastId;exit();
        $s = "INSERT INTO " . $tbl2 . " (
            `project_id`,
            `ticket_id`
        )
        VALUES (
            :project_id,
            :ticket_id
        )";
//        var_dump($s);exit();
        $q = $this->conn->prepare($s);
        $q->bindParam(':project_id', $project_id);
        $q->bindParam(':ticket_id', $lastId);
        $q->execute();
        $q->rowCount();
    }

    /**
     * @param $tbl
     * @return array
     */

    public function readAllTicket($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function joinUserTicket()
    {
        $sql = "SELECT * FROM `users` JOIN `tickets` WHERE users.id = tickets.user_id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function joinCustomerProblemProject()
    {
        $sql = "SELECT 
                      users.id,
                      users.name,
                      tickets.project_name,
                      tickets.user_id,
                      tickets.id,
                      tickets.user_id,
                      tickets.progress,
                      tickets.title, 
                      tickets.description, 
                      tickets.file, 
                      tickets.date_start, 
                      tickets.date_end, 
                      tickets.status
                      FROM `tickets` JOIN `ticket_project`
                                         JOIN `projects`
                                         JOIN `users`
                                         WHERE tickets.id = ticket_project.ticket_id 
                                         AND   projects.id = ticket_project.project_id
                                         AND   projects.user_id = users.id";
        /*
         * SELECT * FROM `t1`
            LEFT JOIN `t2` ON `t2`.`t1_id`=`t1`.`id`
            LEFT JOIN `t3` ON `t3`.`t2_id`=`t2`.`id`
         */
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * @param $sql
     * @return mixed
     */

    public function readTicket($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    /**
     * @param $tbl
     * @param $user_id
     * @param $progress
     * @param $title
     * @param $description
     * @param $file
     * @param $date_start
     * @param $date_end
     * @param $status
     * @param $id
     */

    public function updateTicket($tbl, $user_id, $progress, $title, $description, $file, $date_start, $date_end, $status,$id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `user_id`                = :user_id,
                `progress`               = :progress,
                `title`                  = :title,
                `description`            = :description,
                `file`                   = :file,
                `date_start`             = :date_start,
                `date_end`               = :date_end,
                `status`                 = :status
                 WHERE `id`              = :id
             ";
        $query = $this->conn->prepare($sql);
//        var_dump($query);exit();
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":progress", $progress);
        $query->bindValue(":title", $title);
        $query->bindValue(":description", $description);
        $query->bindValue(":file", $file);
        $query->bindValue(":date_start", $date_start);
        $query->bindValue(":date_end", $date_end);
        $query->bindValue(":status", $status);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }

    /**
     * @param $tbl
     * @param $id
     */

    public function deleteTicket($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }

    public function joinCustomerProjectTicket($username)
    {
        $sql = "SELECT tickets.id,tickets.title,tickets.description,tickets.file,tickets.date_start,tickets.status,projects.project_name,customers.name,customers.email FROM `customers`,`tickets`,`ticket_project` JOIN `projects` WHERE
                                        ticket_project.project_id = projects.id AND customers.id = projects.customer_id AND ticket_project.ticket_id = tickets.id AND `username`='{$username}'";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
}