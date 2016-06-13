<?php
class dbComments {

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
     * @param $ticket_id
     * @param $title
     * @param $email
     * @param $body
     * @param $file
     * @param $date
     * @param $status
     * @param $customer_view
     * @param $pattern_signature
     */
    public function createComments($tbl, $ticket_id, $title, $email, $body, $file, $date, $status,$customer_view,$pattern_signature)
    {
        $sql = "INSERT INTO " . $tbl . " (
            `ticket_id`,
            `title`,
            `email`,
            `body`,
            `file`,
            `date`,
            `status`,
            `customer_view`,
            `pattern_signature`
        )
         VALUES (
            :ticket_id,
            :title,
            :email,
            :body,
            :file,
            :date,
            :status,
            :customer_view,
            :pattern_signature
        )";
        $query = $this->conn->prepare($sql);
//        var_dump($query);exit();
        $query->bindParam(':ticket_id', $ticket_id);
        $query->bindParam(':title', $title);
        $query->bindParam(':email', $email);
        $query->bindParam(':body', $body);
        $query->bindParam(':file', $file);
        $query->bindParam(':date', $date);
        $query->bindParam(':status', $status);
        $query->bindParam(':customer_view', $customer_view);
        $query->bindParam(':pattern_signature', $pattern_signature);
        $query->execute();
        $query->rowCount();
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

    public function readAllComments($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
//    public function joinCustomerProblemProject()
//    {
//        $sql = "SELECT
//                      users.id,
//                      users.name,
//                      tickets.project_name,
//                      tickets.user_id,
//                      tickets.id,
//                      tickets.user_id,
//                      tickets.progress,
//                      tickets.title,
//                      tickets.description,
//                      tickets.file,
//                      tickets.date_start,
//                      tickets.date_end,
//                      tickets.status
//                      FROM `tickets` JOIN `ticket_project`
//                                         JOIN `projects`
//                                         JOIN `users`
//                                         WHERE tickets.id = ticket_project.ticket_id
//                                         AND   projects.id = ticket_project.project_id
//                                         AND   projects.user_id = users.id";
//        /*
//         * SELECT * FROM `t1`
//            LEFT JOIN `t2` ON `t2`.`t1_id`=`t1`.`id`
//            LEFT JOIN `t3` ON `t3`.`t2_id`=`t2`.`id`
//         */
////        var_dump($sql);exit();
//        $query = $this->conn->prepare($sql);
//        $query->execute();
//        $result = $query->fetchAll();
//        return $result;
//    }

    /**
     * @param $sql
     * @return mixed
     */

    public function readComments($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    /**
     * @param $tbl
     * @param $ticket_id
     * @param $title
     * @param $email
     * @param $body
     * @param $file
     * @param $date
     * @param $status
     * @param $customer_view
     * @param $pattern_signature
     * @param $id
     */

    public function updateComments($tbl, $ticket_id, $title, $email, $body, $file, $date, $status, $customer_view, $pattern_signature,$id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `ticket_id`               = :ticket_id,
                `title`                  = :title,
                `email`            = :email,
                `body`                   = :body,
                `file`                   = :file,
                `date`             = :date,
                `status`                 = :status
                `customer_view`               = :customer_view,
                `pattern_signature`               = :pattern_signature,
                 WHERE `id`              = :id
             ";
        $query = $this->conn->prepare($sql);
//        var_dump($query);exit();
        $query->bindValue(":ticket_id", $ticket_id);
        $query->bindValue(":title", $title);
        $query->bindValue(":email", $email);
        $query->bindValue(":body", $body);
        $query->bindValue(":file", $file);
        $query->bindValue(":date", $date);
        $query->bindValue(":status", $status);
        $query->bindValue(":customer_view", $customer_view);
        $query->bindValue(":pattern_signature", $pattern_signature);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }

    /**
     * @param $tbl
     * @param $id
     */

    public function deleteComments($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }

    public function joinCommentTicket()
    {
        $sql = "SELECT comments.id, comments.title,comments.email,comments.body,comments.file,comments.date,comments.status,comments.customer_view,comments.pattern_signature,tickets.title as titleTicket FROM `comments` JOIN `tickets` WHERE
                                        comments.ticket_id = tickets.id";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
}