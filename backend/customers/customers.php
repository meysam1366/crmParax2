<?php
require_once '../../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if (!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}

//$id = intval($_GET['id']);

$admin = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readUser($sql);

$customers = new dbCustomer("support", "localhost", "root", "");
//
$customer = $customers->joinProjectCustomer();
//echo '<pre>';
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
                <a href="../editProfile.php?id=<?= $result['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
            </li>
            <!--                            <li><a href="profile.php?id=-->
            <? //= $result['id']; ?><!--"><i class="halflings-icon user"></i> نمایه</a></li>-->
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

<?php require_once SOFT_ROOT . '/backend/sidebar.php'; ?>

    <!-- start: Content -->
    <div id="content" class="span10">
        <?php
        if ($customer) {
            ?>
            <table class="table table-responsive table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>نام ایجاد کننده مشتری</th>
                    <th>نام پروژه</th>
                    <th>آی دی تلگرام</th>
                    <th>نام مشتری</th>
                    <th>ایمیل مشتری</th>
                    <th>شماره مشتری</th>
                    <th>عملیات</th>
                </tr>
                <?php
                foreach ($customer as $cus) {

                    ?>
                    <tr>
                        <td><?= $cus['id']; ?></td>
                        <td><?= $cus['create_by']; ?></td>
                        <td><?= $cus['project_name']; ?></td>
                        <td><?= $cus['telegram_id']; ?></td>
                        <td><?= $cus['name']; ?></td>
                        <td><?= $cus['email']; ?></td>
                        <td><?= $cus['phone']; ?></td>
                        <td>
                            <a href="../customers/editCustomer.php?id=<?= $cus['id']; ?>" class="btn btn-primary"
                               title="ویرایش">ویرایش</a>
                            <a href="#myModal" role="button" data-toggle="modal" class="btn btn-success"
                               title="نمایش">نمایش</a>
                            <a href="../customers/deleteCustomer.php?id=<?= $cus['id']; ?>" class="btn btn-danger"
                               title="حذف" onclick="return confirm('آیا شما مطمئن هستید؟');">حذف</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
            <?php
        } else {
            echo 'اطلاعاتی برای نمایش وجود ندارد';
        }

?>
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">اطلاعات کامل مشتری</h3>
            </div>
            <div class="modal-body">

                <div class="alert alert-success">
                    نام کاربری
                    <?= $cus['username']; ?>
                </div>
                <div class="alert alert-error">
                    رمز عبور
                    <?= $cus['password']; ?>
                </div>
                <div class="alert alert-success">
                    تاریخ
                    <?= $cus['date']; ?>
                </div>

                <div class="alert alert-success">
                    نوع مشتری
                    <?= $cus['type_project']; ?>
                </div>
                <div class="alert alert-error">
                    یادداشت
                    <?= nl2br($cus['note']); ?>
                </div>
                <div class="alert alert-success">
                    نام شرکت
                    <?= $cus['company']; ?>
                </div>
                <div class="alert alert-error">
                    طرف حساب یا رابط
                    <?= $cus['connector']; ?>
                </div>
                <div class="alert alert-error">
                    آدرس
                    <?= nl2br($cus['address']); ?>
                </div>
            </div>
        </div>
        <a href="<?= BASE_DOMAIN; ?>/backend/customers/addCustomer.php" title="اضافه کردن مشتری جدید"
           class="btn btn-info">اضافه کردن مشتری جدید</a>
    </div><!--/.fluid-container-->

<?php require_once SOFT_ROOT . '/backend/footer.php'; ?>