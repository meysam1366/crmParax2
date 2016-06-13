<?php
ob_start();
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}

$id = intval($_GET['id']);

$admin = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readUser($sql);

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
            <a href="<?= BASE_DOMAIN; ?>/backend/users.php" class="btn btn-success">بازگشت</a>
            <div class="page-header">ویرایش اطلاعات کارمندان</div>
            <div class="container">
                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <label class="control-label" for="name">نام و نام خانوادگی</label>
                        <input type="text" name="name" id="name" class="controls" value="<?= $result['name']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">ایمیل</label>
                        <input type="text" name="email" id="email" class="controls" value="<?= $result['email']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="username">نام کاربری</label>
                        <input type="text" name="username" id="username" class="controls" value="<?= $result['username']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">رمز عبور</label>
                        <input type="password" name="password" id="password" class="controls" value="<?= $result['password']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="post">سمت</label>
                        <input type="text" name="post" id="post" class="form-control" value="<?= $result['post']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="idNumber">شماره پرسنلی</label>
                        <input type="text" name="idNumber" id="idNumber" class="controls" value="<?= $result['idNumber']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="role">سطح دسترسی</label>
                        <select name="role" id="role">
                            <option class="form-control" value="Admin">مدیر</option>
                            <option class="form-control" value="Technical">فنی</option>
                            <option class="form-control" value="Supported">پشتیبانی</option>
                            <option class="form-control" value="Expert">کارشناس فنی</option>
                            <option class="form-control" value="Graphic">گرافیست</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <input type="submit" name="edit" id="edit" class="btn btn-success" value="ویرایش">
                    </div>
                </form>
            </div>

            <?php
                if (isset($_POST['edit'])) {
                    $id = $_GET['id'];
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $post = $_POST['post'];
                    $idNumber = $_POST['idNumber'];
                    $role = $_POST['role'];
                    $url = 'users.php';
                    $result = $admin->updateUser("users", $name, $email, $username, $password, $post, $idNumber, $role, $id);
                    header("Location: users.php");
                    exit();
                }

            ?>

        </div><!--/.fluid-container-->

<?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
<?php
ob_end_flush();