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

$admin = new dbDomain("support", "localhost", "root", "");

$user = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readAllDomain('website');

$user = $user->readUser($sql);
require_once SOFT_ROOT . '/backend/header.php';
?>

                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?= $user['name']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <a href="../editUser.php?id=<?= $user['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
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
                if ($result) {
                    ?>
                    <table class="table table-responsive table-bordered table-striped">
                        <tr>
                            <th>ردیف</th>
                            <th>نام دامنه</th>
                            <th>آدرس دامنه</th>
                            <th>نام کاربری پنل</th>
                            <th>رمز عبور پنل</th>
                            <th>هزینه دامنه</th>
                            <th>تاریخ شروع دامنه</th>
                            <th>تاریخ انقضای دامنه</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        foreach ($result as $domain) {

                            ?>
                            <tr>
                                <td><?= $domain['id']; ?></td>
                                <td><?= $domain['domain_name']; ?></td>
                                <td><?= $domain['domain_url']; ?></td>
                                <td><?= $domain['user_panel']; ?></td>
                                <td><?= $domain['pass_panel']; ?></td>
                                <td><?= $domain['domain_price']; ?></td>
                                <td><?= $domain['domain_date_start']; ?></td>
                                <td><?= $domain['domain_date_expired']; ?></td>
                                <td>
                                    <a href="editDomain.php?id=<?= $domain['id']; ?>" class="btn btn-primary"
                                       title="ویرایش">ویرایش</a>
                                    <!-- Button to trigger modal -->
                                    <a href="#myModal" role="button" data-toggle="modal" class="btn btn-success"
                                       title="ویرایش">نمایش</a>

                                    <!-- Modal -->
                                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel">اطلاعات کامل دامنه</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-success">
                                                نام دامنه
                                                <?= $domain['domain_name']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                آدرس دامنه
                                                <?= $domain['domain_url']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                نام کاربری پنل
                                                <?= $domain['user_panel']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                رمز عبور پنل
                                                <?= $domain['pass_panel']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                هزینه دامنه
                                                <?= $domain['domain_price']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                تاریخ شروع دامنه
                                                <?= $domain['domain_date_start']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                تاریخ انقضای دامنه
                                                <?= $domain['domain_date_expired']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                هزینه هاست
                                                <?= $domain['host_price']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                تاریخ شروع هاست
                                                <?= $domain['host_date_start']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                تاریخ انقضای هاست
                                                <?= $domain['host_date_expired']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                نام ادمین سایت
                                                <?= $domain['name_admin_site']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                تلفن ادمین سایت
                                                <?= $domain['phone_admin_site']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                ایمیل ادمین سایت
                                                <?= $domain['email_admin_site']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                نام کاربری شبکه اجتماعی
                                                <?= $domain['user_social_network']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                رمز عبور شبکه اجتماعی
                                                <?= $domain['pass_social_network']; ?>
                                            </div>
                                            <div class="alert alert-error">
                                                نام کاربری وبلاگ
                                                <?= $domain['user_weblog']; ?>
                                            </div>
                                            <div class="alert alert-success">
                                                رمز عبور وبلاگ
                                                <?= $domain['pass_weblog']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="deleteDomain.php?id=<?= $domain['id']; ?>" class="btn btn-danger"
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
            <a href="addDomain.php" title="اضافه کردن دامنه جدید" class="btn btn-info">اضافه کردن دامنه جدید</a>
        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>