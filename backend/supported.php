<?php
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Supported'])) {
        header("Location: login.php");
        exit();
    }
}

$admin = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Supported']}'";
$result = $admin->readUser($sql);
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
                    <a href="supported.php">صفحه اصلی</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="supported.php">مدیریت</a></li>
            </ul>

            <div class="row-fluid">

                <a class="quick-button metro yellow span3" href="users.php">
                    <i class="icon-group"></i>
                    <p>کارمندان</p>
                    <span class="badge"><?= count($count); ?></span>
                </a>
                <a class="quick-button metro red span3">
                    <i class="icon-comments-alt"></i>
                    <p>نظرات</p>
                    <span class="badge">46</span>
                </a>
                <a class="quick-button metro green span3">
                    <i class="icon-barcode"></i>
                    <p>پروژه ها</p>
                    <span class="badge">46</span>
                </a>
                <a class="quick-button metro pink span3">
                    <i class="icon-envelope"></i>
                    <p>پیامها</p>
                    <span class="badge">88</span>
                </a>
                <div class="clearfix"></div>

            </div><!--/row-->



        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>

