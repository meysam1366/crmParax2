<?php
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}
//echo 'سلام مدیر';

$admin = new dbUser("support", "localhost", "root", "");

$info = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readUser($sql);

$count = $info->readAllUser('users');

$project = new dbProject("support", "localhost", "root", "");

$countProject = $project->readAllProject('projects');

$tickets = new dbTicket("support", "localhost", "root", "");

$countTicket = $tickets->readAllTicket('tickets');

$customers = new dbCustomer("support", "localhost", "root", "");

$countCustomer = $customers->readAllCustomer('customers');

$comments = new dbComments("support", "localhost", "root", "");

$countComment = $comments->readAllComments('comments');

$domains = new dbDomain("support", "localhost", "root", "");

$countDomain = $domains->readAllDomain('website');

//$config = new Config();
//
//print_r($result);

require_once SOFT_ROOT . '/backend/header.php';
?>

<!-- start: User Dropdown -->
<li class="dropdown">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="halflings-icon white user"></i> <?= $result['name']; ?>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-menu-title">
            <a href="editProfile.php?id=<?= $result['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
        </li>
        <!--                            <li><a href="profile.php?id=--><?//= $result['id']; ?><!--"><i class="halflings-icon user"></i> نمایه</a></li>-->
        <li><a href="logout.php"><i class="halflings-icon off"></i> خروج</a></li>
    </ul>
</li>
<!-- end: User Dropdown -->
</ul>
</div>
<!-- end: Header Menu -->

</div>
</div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">
        <?php require_once 'sidebar.php'; ?>
        <!-- start: Content -->
        <div id="content" class="span10">


            <ul class="breadcrumb text-right">
                <li>
                    <i class="icon-home"></i>
                    <a href="dashboard.php">صفحه اصلی</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="dashboard.php">مدیریت</a></li>
            </ul>

            <div class="row-fluid">

                <form class="form-inline" action="" method="post">
                    <label for="pass">رمز مورد نظر را وارد کنید</label>
                    <input type="text" name="passGenerate" class="controls" id="pass">
                    <input class="btn btn-primary" type="submit" name="generate" value="تولید کن" id="submit">
                </form>

                رمز تولید شده را کپی کنید
                <div id="generate"></div>

            </div><!--/row-->

        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
