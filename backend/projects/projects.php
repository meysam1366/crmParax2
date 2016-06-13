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

$admin = new dbProject("support", "localhost", "root", "");

$j = $admin->joinUserProject();

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
                        <th>ردیف</th>
                        <th>نام ایجاد کننده پروژه</th>
                        <th>نام پروژه</th>
                        <th>نام کاربر</th>
                        <th>توضیحات</th>
                        <th>تاریخ ایجاد پروژه</th>
                        <th>تاریخ شروع پروژه</th>
                        <th>تاریخ پایان پروژه</th>
                        <th>تاریخ شروع پشتیبانی</th>
                        <th>هزینه پروژه</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    foreach ($j as $projects) {

                        ?>
                        <tr>
                            <td><?= $projects['id']; ?></td>
                            <td><?= $projects['create_by']; ?></td>
                            <td><?= $projects['project_name']; ?></td>
                            <td><?= $projects['name']; ?></td>
                            <td><?= $projects['description']; ?></td>
                            <td><?= $projects['date_create']; ?></td>
                            <td><?= $projects['date_in']; ?></td>
                            <td><?= $projects['date_out']; ?></td>
                            <td><?= $projects['date_start_support']; ?></td>
                            <td><?= $projects['price']; ?></td>
                            <td>
                                <a href="editProject.php?id=<?= $projects['id']; ?>" class="btn btn-primary"
                                   title="ویرایش">ویرایش</a>
                                <a href="deleteProject.php?id=<?= $projects['id']; ?>" class="btn btn-danger"
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
            <a href="addProject.php" title="اضافه کردن پروژه جدید" class="btn btn-info">اضافه کردن پروژه جدید</a>
        </div><!--/.fluid-container-->

        <?= require_once SOFT_ROOT . '/backend/footer.php'; ?>
