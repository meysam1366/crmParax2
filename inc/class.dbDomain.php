<?php
class dbDomain {

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


    public function createDomain($tbl, $domain_name, $domain_url, $user_panel, $pass_panel, $domain_price, $domain_date_start, $domain_date_expired, $host_price, $host_date_start, $host_date_expired, $name_admin_site, $phone_admin_site, $email_admin_site, $user_social_network, $pass_social_network, $user_weblog, $pass_weblog)
    {
        $sql = "INSERT INTO " . $tbl . " (
            `domain_name`,
            `domain_url`,
            `user_panel`,
            `pass_panel`,
            `domain_price`,
            `domain_date_start`,
            `domain_date_expired`,
            `host_price`,
            `host_date_start`,
            `host_date_expired`,
            `name_admin_site`,
            `phone_admin_site`,
            `email_admin_site`,
            `user_social_network`,
            `pass_social_network`,
            `user_weblog`,
            `pass_weblog`
        )
         VALUES (
            :domain_name,
            :domain_url,
            :user_panel,
            :pass_panel,
            :domain_price,
            :domain_date_start,
            :domain_date_expired,
            :host_price,
            :host_date_start,
            :host_date_expired,
            :name_admin_site,
            :phone_admin_site,
            :email_admin_site,
            :user_social_network,
            :pass_social_network,
            :user_weblog,
            :pass_weblog
        )";
        $query = $this->conn->prepare($sql);
//        var_dump($query);exit();
        $query->bindParam(':domain_name', $domain_name);
        $query->bindParam(':domain_url', $domain_url);
        $query->bindParam(':user_panel', $user_panel);
        $query->bindParam(':pass_panel', $pass_panel);
        $query->bindParam(':domain_price', $domain_price);
        $query->bindParam(':domain_date_start', $domain_date_start);
        $query->bindParam(':domain_date_expired', $domain_date_expired);
        $query->bindParam(':host_price', $host_price);
        $query->bindParam(':host_date_start', $host_date_start);
        $query->bindParam(':host_date_expired', $host_date_expired);
        $query->bindParam(':name_admin_site', $name_admin_site);
        $query->bindParam(':phone_admin_site', $phone_admin_site);
        $query->bindParam(':email_admin_site', $email_admin_site);
        $query->bindParam(':user_social_network', $user_social_network);
        $query->bindParam(':pass_social_network', $pass_social_network);
        $query->bindParam(':user_weblog', $user_weblog);
        $query->bindParam(':pass_weblog', $pass_weblog);
        $query->execute();
        $query->rowCount();
    }
    
    public function readAllDomain($tbl)
    {
        $sql = "SELECT * FROM " . $tbl;
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
    
    public function readDomain($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function updateDomain($tbl, $domain_name, $domain_url, $user_panel, $pass_panel, $domain_price, $domain_date_start, $domain_date_expired, $host_price, $host_date_start, $host_date_expired, $name_admin_site, $phone_admin_site, $email_admin_site, $user_social_network, $pass_social_network, $user_weblog, $pass_weblog,$id)
    {
        $sql = "UPDATE " . $tbl . " SET 
                `domain_name`                 = :domain_name,
                `domain_url`                  = :domain_url,
                `user_panel`                  = :user_panel,
                `pass_panel`                  = :pass_panel,
                `domain_price`                = :domain_price,
                `domain_date_start`           = :domain_date_start,
                `domain_date_expired`         = :domain_date_expired,
                `host_price`                  = :host_price,
                `host_date_start`             = :host_date_start,
                `host_date_expired`           = :host_date_expired,
                `name_admin_site`             = :name_admin_site,
                `phone_admin_site`            = :phone_admin_site,
                `email_admin_site`            = :email_admin_site, 
                `user_social_network`         = :user_social_network, 
                `pass_social_network`         = :pass_social_network, 
                `user_weblog`                 = :user_weblog, 
                `pass_weblog`                 = :pass_weblog
                 WHERE `id`                   = :id
             ";
//        var_dump($sql);exit();
        $query = $this->conn->prepare($sql);
        $query->bindValue(":domain_name", $domain_name);
        $query->bindValue(":domain_url", $domain_url);
        $query->bindValue(":user_panel", $user_panel);
        $query->bindValue(":pass_panel", $pass_panel);
        $query->bindValue(":domain_price", $domain_price);
        $query->bindValue(":domain_date_start", $domain_date_start);
        $query->bindValue(":domain_date_expired", $domain_date_expired);
        $query->bindValue(":host_price", $host_price);
        $query->bindValue(":host_date_start", $host_date_start);
        $query->bindValue(":host_date_expired", $host_date_expired);
        $query->bindValue(":name_admin_site", $name_admin_site);
        $query->bindValue(":phone_admin_site", $phone_admin_site);
        $query->bindValue(":email_admin_site", $email_admin_site);
        $query->bindValue(":user_social_network", $user_social_network);
        $query->bindValue(":pass_social_network", $pass_social_network);
        $query->bindValue(":user_weblog", $user_weblog);
        $query->bindValue(":pass_weblog", $pass_weblog);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
        
    }
    
    public function deleteDomain($tbl, $id)
    {
        $sql = "DELETE FROM " . $tbl . " WHERE `id` = :id";
        $query = $this->conn->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        $query->rowCount();
    }
}