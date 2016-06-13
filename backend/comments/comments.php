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

$comments = new dbComments("support", "localhost", "root", "");

$j = $comments->joinCommentTicket();

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
                        <th>عنوان تیکت</th>
                        <th>عنوان پیام</th>
                        <th>ایمیل مشتری</th>
                        <th>متن پیام</th>
                        <th>فایل</th>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                        <th>مشاهده مشتری</th>
                        <th>الگوی امضاء</th>
                        <th>عملیات</th>
                    </tr>
                    <?php
                    foreach ($j as $comment) {

                        ?>
                        <tr>
                            <td><?= $comment['id']; ?></td>
                            <td><?= $comment['titleTicket']; ?></td>
                            <td><?= $comment['title']; ?></td>
                            <td><?= $comment['email']; ?></td>
                            <td><?= $comment['body']; ?></td>
                            <td><?= ($comment['file'] ? "<img class='img-responsive img-thumbnail' src='" . BASE_DOMAIN . "/frontend/img/" . $comment["file"] . "' alt='" . $comment['file'] . "'>" : 'ندارد') ?></td>
                            <td><?= $comment['date']; ?></td>
                            <td><?= ($comment['status']==0 ? 'غیرفعال' : 'فعال'); ?></td>
                            <td><?= ($comment['customer_view'] == 0 ? 'خیر' : 'بله'); ?></td>
                            <td><?= ($comment['pattern_signature'] == null ? 'ندارد' : $comment['pattern_signature']); ?></td>
                            <td>
                                <a href="editComment.php?id=<?= $comment['id']; ?>" class="btn btn-primary"
                                   title="ویرایش">ویرایش</a>
                                <a href="deleteComment.php?id=<?= $comment['id']; ?>" class="btn btn-danger"
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
