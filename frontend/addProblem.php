<?php
//echo $project_name;exit();
//header("Location: login.php");
require_once '../core/core.php';
$problems = new dbTicket("support", "localhost", "root", "");

$domains = new dbDomain("support", "localhost", "root", "");

//$domain = $domains->readDomain("SELECT ");

if (isset($_POST['send'])) {
    $project_id = $_POST['project_name'];
    $user_id = 1;
    $progress = '0%';
    $title = $_POST['title'];
    $description = $_POST['description'];
    date_default_timezone_set('Asia/Tehran');
    $date_start = date('Y-m-d');
    $date_end = date('Y-m-d');
    $status = 0;
    $file = $_FILES['file']['name'];
    $type_file = (isset($_FILES['file']['type']) ? $_FILES['file']['type'] : '');
    $old_dir = $_FILES['file']['tmp_name'];
    $new_dir = SOFT_ROOT . '/frontend/img/';
    $new_dir = $new_dir . $file;

    if($type_file == 'image/jpeg' || $type_file == 'image/jpg' || $type_file == 'image/png') {
        if (move_uploaded_file($old_dir, "$new_dir")) {
            $problem = $problems->createTicket('tickets', $user_id, $progress, $title, $description, $file, $date_start, $date_end, $status, $project_id);
            header("Location: panel.php");
            exit();
        } else {
            echo "File was not uploaded";
        }
    }else {
        if ($type_file == "") {
            $file = "ندارد";
            $problem = $problems->createTicket('tickets', $user_id, $progress, $title, $description, $file, $date_start, $date_end, $status, $project_id);
        } else {
            echo 'فرمت فایل آپلود شده شما غیر مجاز است';
        }
    }
//    $lastId = $problems->lastInsertId('ticket_project');
//        header("Location: showProblem.php");
//        exit();
}