<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!$_SESSION['Customer']) {
    header("Location: login.php");
    exit();
}
require_once '../core/core.php';

$db = new dbProject("support", "localhost", "root", "");

$tickets = new dbTicket("support", "localhost", "root", "");

//$result = $db->joinCustomerProject();

$username = $_SESSION['Customer'];

$joinTickets = $tickets->joinCustomerProjectTicket($username);

$comments = new dbComments("support", "localhost", "root", "");

$comment = $comments->joinCommentTicket();
//echo '<pre>';
//print_r($comment);
//echo '</pre>';
//exit();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?> | پروفایل <?= $joinTickets[0]['name'] ?> </title>
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="panel.php"><?= $joinTickets[0]['name'] ?></a>
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
            <?php
            if ($joinTickets) {
                ?>
                <div class="page-header">تیکت ها</div>
                <table id="example" class="table table-bordered table-striped table-responsive text-center">
                    <tr>
                        <th>عنوان تیکت</th>
                        <th>نام پروژه</th>
                        <th>توضیحات</th>
                        <th>نام فایل</th>
                        <th>تاریخ ثبت</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>

                    <?php
                    foreach ($joinTickets as $ticket) {
                        $date = strtotime($ticket['date_start']);

                        ?>
                        <tr>
                            <td><?= $ticket['title'] ?></td>
                            <td><?= $ticket['project_name'] ?></td>
                            <td><?= $ticket['description'] ?></td>
                            <td><?= ($ticket['file'] ? "<img class='img-responsive img-thumbnail' src='" . BASE_DOMAIN . "/frontend/img/" . $ticket["file"] . "' alt='" . $ticket['title'] . "'>" : 'ندارد') ?></td>
                            <td><?= jdate('Y-m-d', $date); ?></td>
                            <td><?= ($ticket['status'] == 0 ? 'بسته' : 'باز'); ?></td>
                            <td>
                                <a href="editTicket.php?id=<?= $ticket['id'] ?>" title="ویرایش"
                                   class="btn btn-primary">ویرایش</a>
                                <a href="viewTicket.php?id=<?= $ticket['id'] ?>" title="ویرایش"
                                   class="btn btn-success">نمایش</a>
                                <a href="deleteTicket.php?id=<?= $ticket['id'] ?>" title="نمایش"
                                   class="btn btn-danger" onclick="return confirm('آیا شما مطمئن هستید؟')">
                                    حذف</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
            <?php
            if ($comment) {
                ?>
                <div class="page-header">پیام ها</div>
                <table id="example" class="table table-bordered table-striped table-responsive text-center">
                    <tr>
                        <th>عنوان پیام</th>
                        <th>ایمیل</th>
                        <th>متن پیام</th>
                        <th>نام فایل</th>
                        <th>تاریخ ثبت</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>

                    <?php
                    foreach ($comment as $comments) {
                        $date = strtotime($comments['date']);

                        ?>
                        <tr>
                            <td><?= $comments['title'] ?></td>
                            <td><?= $comments['email'] ?></td>
                            <td><?= $comments['body'] ?></td>
                            <td><?= ($comments['file'] ? "<img class='img-responsive img-thumbnail' src='" . BASE_DOMAIN . "/frontend/img/" . $comments["file"] . "' alt='" . $comments['title'] . "'>" : 'ندارد') ?></td>
                            <td><?= jdate('Y-m-d', $date); ?></td>
                            <td><?= ($comments['status'] == 0 ? 'بسته' : 'باز'); ?></td>
                            <td>
                                <a href="editTicket.php?id=<?= $comments['id'] ?>" title="ویرایش"
                                   class="btn btn-primary">ویرایش</a>
                                <a href="viewTicket.php?id=<?= $comments['id'] ?>" title="ویرایش"
                                   class="btn btn-success">نمایش</a>
                                <a href="deleteTicket.php?id=<?= $comments['id'] ?>" title="نمایش"
                                   class="btn btn-danger" onclick="return confirm('آیا شما مطمئن هستید؟')">
                                    حذف</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
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
<script type="text/javascript" src="<?= BASE_DOMAIN ?>/backend/assets/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?= BASE_DOMAIN ?>/backend/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= BASE_DOMAIN ?>/backend/assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>
