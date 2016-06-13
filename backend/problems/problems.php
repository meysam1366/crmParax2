<?php
require_once '../../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}

//$id = intval($_GET['id']);

$user = new dbUser("support", "localhost", "root", "");

$r = $user->readUser("SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'");

$admin = new dbProblem("support", "localhost", "root", "");

$j = $admin->joinCustomerProblemProject();

//echo '<pre>';
//
//print_r($j);
//
//exit();

require_once SOFT_ROOT . '/backend/header.php';
?>

<!-- start: User Dropdown -->
<li class="dropdown">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="halflings-icon white user"></i> <?= $r['name']; ?>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-menu-title">
            <a href="../editProfile.php?id=<?= $r['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
        </li>
        <!--                            <li><a href="profile.php?id=--><?//= $result['id']; ?><!--"><i class="halflings-icon user"></i> نمایه</a></li>-->
        <li><a href="../logout.php"><i class="halflings-icon off"></i> خروج</a></li>
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

        <?php require_once '../sidebar.php'; ?>

        <!-- start: Content -->
        <div id="content" class="span10">
            <?php
            if ($j) {
                ?>
                <table class="table table-responsive table-bordered table-striped">
                    <tr>
<!--                        <th>ردیف</th>-->
                        <th>نام پروژه</th>
                        <th>نام کاربر</th>
                        <th>عنوان مشکل</th>
                        <th>توضیحات</th>
                        <th>تاریخ ایجاد پروژه</th>
                        <th>تاریخ شروع پروژه</th>
                        <th>تاریخ پایان پروژه</th>
                        <th>تاریخ شروع پشتیبانی</th>
                        <th>هزینه پروژه</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    foreach ($j as $problem) {

                        ?>
                        <tr>
<!--                            <td>--><?//= $problem['id']; ?><!--</td>-->
                            <td><?= $problem['project_name']; ?></td>
                            <td><?= $problem['name']; ?></td>
                            <td><?= $problem['title']; ?></td>
                            <td><?= $problem['description']; ?></td>
                            <td><?= $problem['date_start']; ?></td>
                            <td><?= $problem['date_end']; ?></td>
                            <td><?= $problem['date_out']; ?></td>
                            <td><?= $problem['progress']; ?></td>
                            <td><?= $problem['status']; ?></td>
                            <td>
                                <a href="editProblem.php?id=<?= $problem['id']; ?>" class="btn btn-primary"
                                   title="ویرایش">ویرایش</a>
                                <a href="deleteProblem.php?id=<?= $problem['id']; ?>" class="btn btn-danger"
                                   title="حذف" onclick="return confirm('آیا شما مطمئن هستید؟');">حذف</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }else {
                echo 'اطلاعاتی برای نمایش وجود ندارد';
            }
            ?>
        </div><!--/.fluid-container-->

        <?= require_once SOFT_ROOT . '/backend/footer.php'; ?>
