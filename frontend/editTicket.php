<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!$_SESSION['Customer']) {
    header("Location: login.php");
    exit();
}
require_once '../core/core.php';
$tickets = new dbTicket("support", "localhost", "root", "");

$id = intval($_GET['id']);

$sql = "SELECT * FROM `tickets` WHERE `id`='{$id}'";

$t = $tickets->readTicket($sql);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?></title>
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="" enctype="multipart/form-data" method="post" class="form-horizontal col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="title">عنوان</label>
                        <input type="text" name="title" value="<?= $t['title'] ?>" id="title" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات</label>
                        <textarea id="description" cols="5" rows="7" name="description" class="form-control" required="required"><?= $t['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <span><img width="500px" height="200px" src="<?= BASE_DOMAIN; ?>/frontend/img/<?= $t['file'] ?>" alt="<?= $t['title'] ?>"></span>
                        <label class="control-label" for="file">انتخاب عکس جدید</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="ویرایش" name="update" class="btn btn-large">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <?php
                    require_once SOFT_ROOT . '/frontend/sidebar.php';
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['update'])) {
    $user_id = 1;
    $progress = '0%';
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_start = $t['date_start'];
    $date_end = $t['date_start'];
    $status = $t['status'];
    $file = $_FILES['file']['name'];
    $type_file = (isset($_FILES['file']['type']) ? $_FILES['file']['type'] : '');
    $old_dir = $_FILES['file']['tmp_name'];
    $new_dir = SOFT_ROOT . '/frontend/img/';
    $new_dir = $new_dir . $file;

    if($type_file == 'image/jpeg' || $type_file == 'image/jpg' || $type_file == 'image/png') {
        if (move_uploaded_file($old_dir, "$new_dir")) {
            echo "Uploaded";
            $ticket = $tickets->updateTicket('tickets',$user_id,$status,$title,$description,$file,$date_start,$date_end,$status, $id);
        } else {
            echo "File was not uploaded";
        }
    }else {
        if ($type_file == "") {
            $file = $t['file'];
            $ticket = $tickets->updateTicket('tickets',$user_id,$status,$title,$description,$file,$date_start,$date_end,$status, $id);
        } else {
            echo 'فرمت فایل آپلود شده شما غیر مجاز است';
        }
    }

    header("Location: panel.php");
    exit();
}
