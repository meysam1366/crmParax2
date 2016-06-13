<?php
ob_start();
require_once '../../core/core.php';
if (!isset($_SESSION)) {
    session_start();

    if(!isset($_SESSION['Admin'])) {
        header("Location: login.php");
        exit();
    }
}

$users = new dbUser("support", "localhost", "root", "root");
$sql = "SELECT id,name FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";
$userAdmin = $users->readUser($sql);

$project = new dbProject("support", "localhost", "root", "root");

$domain = new dbDomain("support", "localhost", "root", "root");

$res = $domain->readAllDomain('website');
require_once SOFT_ROOT . '/backend/header.php';
?>

                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="halflings-icon white user"></i> <?= $userAdmin['name']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">
                                    <a href="../editProfile.php?id=<?= $userAdmin['id']; ?>" title="ویرایش پروفایل">ویرایش پروفایل</a>
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

            <?php require_once '../sidebar.php';

            $conn = new PDO("mysql:host=localhost;dbname=support;charset=utf8;", "root", "root");
            $sql = "SELECT * FROM users WHERE `role` = 'Expert'";
            $query = $conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
//            var_dump($result);
//            exit();
            ?>

            <!-- start: Content -->
            <div id="content" class="span10">
                <div class="page-header">اضافه کردن پروژه جدید</div>
                <div class="container">
                    <form class="form-horizontal" action="" method="post">
                        <div class="control-group">
                            <label class="control-label" for="ProjectName">نام پروژه</label>
                            <input type="text" name="ProjectName" id="ProjectName" class="controls" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="domain">دامنه</label>
                            <select name="domain" id="domain">
                                <?php
                                foreach ($res as $domain) {
                                    ?>
                                    <option class="form-control" value="<?= $domain['id'] ?>"><?= $domain['domain_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="expert">کارمند</label>
                            <select name="expert" id="expert">
                                <?php
                                foreach ($result as $user) {
                                    ?>
                                    <option class="form-control" value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="description">توضیحات پروژه</label>
                            <textarea name="description" id="description" cols="5" rows="7" class="controls" required title="رمز عبور"></textarea>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date_create">تاریخ ایجاد پروژه</label>
                            <input type="text" name="date_create" id="date_create" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date_in">تاریخ شروع پروژه</label>
                            <input type="text" name="date_in" id="date_in" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date_out">تاریخ پایان پروژه</label>
                            <input type="text" name="date_out" id="date_out" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date_start_support">تاریخ شروع پشتیبانی</label>
                            <input type="text" name="date_start_support" id="date_start_support" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="price">هزینه پروژه</label>
                            <input type="text" name="price" id="price" class="form-control" required title="سمت">
                        </div>

                        <div class="control-group">
                            <input type="submit" name="add" id="add" class="btn btn-success" value="ثبت">
                        </div>
                    </form>
                </div>

                <?php
                    if (isset($_POST['add'])) {
                        $ProjectName = $_POST['ProjectName'];
                        $domain = $_POST['domain'];
                        $expert = $_POST['expert'];
                        $description = $_POST['description'];
                        $date_create = $_POST['date_create'];
                        $date_in = $_POST['date_in'];
                        $date_out = $_POST['date_out'];
                        $create_by = $userAdmin['name'];
                        $date_start_support = $_POST['date_start_support'];
                        $price = $_POST['price'];
                        $result = $project->createProject("projects",
                            $domain,
                            $ProjectName,
                            $expert,
                            $description,
                            $date_in,
                            $date_out,
                            $date_start_support,
                            $price,
                            $date_create,
                            $create_by
                        );
//                        var_dump($result);exit();
                        header("Location: projects1.php");
                        exit();
                    }
//                ?>

            </div><!--/.fluid-container-->

<?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
<?php
ob_end_flush();