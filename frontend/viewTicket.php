<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
if(!$_SESSION['Customer']) {
    header("Location: login.php");
    exit();
}
require_once '../core/core.php';
$tickets = new dbTicket("support", "localhost", "root", "");

$emails = new dbCustomer("support", "localhost", "root", "");

$id = intval($_GET['id']);

$sql = "SELECT * FROM `tickets` WHERE `id`='{$id}'";

$t = $tickets->readTicket($sql);
$date = strtotime($t['date_start']);

$username = $_SESSION['Customer'];

$sqlCustomer = "SELECT * FROM `customers` WHERE username='{$username}'";

$email = $emails->readCustomer($sqlCustomer);
$comments = new dbComments("support", "localhost", "root", "");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?></title>
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/persian-datepicker-0.4.5.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $t['title'] ?></td>
                            <td><?= $t['description'] ?></td>
                            <td><?= jdate('Y-m-d', $date) ?></td>
                            <td><?= ($t['status'] == '0' ? 'بسته' : 'باز') ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if ($comments) {
                ?>
                    <div class="col-md-6">
                        <div class="page-header">پیام ها</div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">عنوان پیام</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input type="text" id="email" name="email" value="<?= $email['email'] ?>" readonly="readonly" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="body">متن پیام</label>
                                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">فایل</label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="send" value="ارسال" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-md-3">
                <?php
                    require_once SOFT_ROOT . '/frontend/sidebar.php';
                ?>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?= BASE_DOMAIN; ?>/backend/assets/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?= BASE_DOMAIN; ?>/backend/assets/js/persian-date-0.1.8.min.js"></script>
<script type="text/javascript" src="<?= BASE_DOMAIN; ?>/backend/assets/js/persian-datepicker-0.4.5.min.js"></script>
<script type="text/javascript" src="<?= BASE_DOMAIN; ?>/backend/assets/js/main.js"></script>
</body>
</html>
<?php
if (isset($_POST['send'])) {

    $ticket_id = $t['id'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $body = nl2br($_POST['body']);
    $file = $_FILES['file']['name'];
    $date = date('Y-m-d');
    $status = 0;
    $customer_view = 0;
    $pattern_signature = null;
    $type_file = (isset($_FILES['file']['type']) ? $_FILES['file']['type'] : '');
    $old_dir = $_FILES['file']['tmp_name'];
    $new_dir = SOFT_ROOT . '/frontend/img/';
    $new_dir = $new_dir . $file;

    if($type_file == 'image/jpeg' || $type_file == 'image/jpg' || $type_file == 'image/png') {
        if (move_uploaded_file($old_dir, "$new_dir")) {
            $comment = $comments->createComments('comments', $ticket_id, $title, $email, $body, $file, $date, $status, $customer_view, $pattern_signature);
            header("Location: panel.php");
            exit();
        } else {
            echo "File was not uploaded";
        }
    }else {
        if ($type_file == "") {
            $file = "ندارد";
            $comment = $comments->createComments('comments', $ticket_id, $title, $email, $body, $file, $date, $status, $customer_view, $pattern_signature);
            header("Location: panel.php");
            exit();
        } else {
            echo 'فرمت فایل آپلود شده شما غیر مجاز است';
        }
    }
}
ob_end_flush();