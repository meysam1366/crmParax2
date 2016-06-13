<?php
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}

//$id = intval($_GET['id']);

$admin = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$users = $admin->readUser($sql);

$result = $admin->readAllUser('users');
//echo '<pre>';
//print_r($result);
require_once SOFT_ROOT . '/backend/header.php';
?>

                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?= $users['name']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <a href="editProfile.php?id=<?= $users['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
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
            <form action="" class="form-inline" method="get">
                <div class="control-group">
                    <label for="search">جستجو</label>
                    <input type="text" name="search" id="search" class="controls" placeholder="جستجو ...">
                </div>
                <div class="control-group">
                    <input type="submit" name="search_btn" value="جستجو کن" class="btn btn-primary search_btn">
                </div>
            </form>
            <?php
                if ($result) {
                    ?>
                    <table class="table table-responsive table-bordered table-striped search_result">
                        <tr>
                            <th>ردیف</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>نام کاربری</th>
                            <th>رمز عبور</th>
                            <th>سمت</th>
                            <th>شماره پرسنلی</th>
                            <th>سطح دسترسی</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        foreach ($result as $user) {

                            ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['password']; ?></td>
                                <td><?= $user['post']; ?></td>
                                <td><?= $user['idNumber']; ?></td>
                                <td><?= $user['role']; ?></td>
                                <td>
                                    <a href="editUser.php?id=<?= $user['id']; ?>" class="btn btn-primary"
                                       title="ویرایش">ویرایش</a>
                                    <a href="deleteUser.php?id=<?= $user['id']; ?>" class="btn btn-danger"
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
            <a href="addUser.php" title="اضافه کردن کارمند جدید" class="btn btn-info">اضافه کردن کارمند جدید</a>
        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
