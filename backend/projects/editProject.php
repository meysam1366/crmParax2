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

$id = intval($_GET['id']);

$admin = new dbUser("support", "localhost", "root", "");


$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $admin->readUser($sql);

$project = new dbProject("support", "localhost", "root", "");

$s = "SELECT * FROM `projects` WHERE `id` = '{$id}'";

$p = $project->readProject($s);

$domain = new dbDomain("support", "localhost", "root", "");

$res = $domain->readAllDomain('website');

//print_r($p);
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
        $r = $query->fetchAll();
        ?>

        <!-- start: Content -->
        <div id="content" class="span10">
            <a href="<?= BASE_DOMAIN; ?>/backend/projects/projects.php" class="btn btn-success">بازگشت</a>
            <div class="page-header">ویرایش پروژه ها</div>
            <div class="container">
                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <label class="control-label" for="projectName">نام پروژه</label>
                        <input type="text" name="projectName" id="projectName" class="controls" value="<?= $p['project_name']; ?>">
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
                            foreach ($r as $user) {
                                ?>
                                <option class="form-control" value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="problem_id">آی دی مشکل پروژه</label>
                        <input type="text" name="problem_id" id="problem_id" class="controls" value="<?= $p['problem_id']; ?>">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description">توضیحات پروژه</label>
                        <textarea name="description" id="description" cols="5" rows="7" class="controls" required title="رمز عبور"><?= $p['description']; ?></textarea>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date_in">تاریخ شروع پروژه</label>
                        <input type="text" name="date_in" id="date_in" class="controls" value="<?= $p['date_in']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date_out">تاریخ پایان پروژه</label>
                        <input type="text" name="date_out" id="date_out" class="controls" value="<?= $p['date_out']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date_start_support">تاریخ شروع پشتیبانی</label>
                        <input type="text" name="date_start_support" id="date_start_support" class="controls" value="<?= $p['date_start_support']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="price">هزینه پروژه</label>
                        <input type="text" name="price" id="price" class="form-control" value="<?= $p['price']; ?>" required title="سمت">
                    </div>
                    <div class="control-group">
                        <input type="submit" name="edit" id="edit" class="btn btn-success" value="ویرایش">
                    </div>
                </form>
            </div>

            <?php
                if (isset($_POST['edit'])) {
                    $id = $_GET['id'];
                    $domain = $_POST['domain'];
                    $projectName = $_POST['projectName'];
                    $expert = $_POST['expert'];
                    $problem_id = $_POST['problem_id'];
                    $description = $_POST['description'];
                    $date_in = $_POST['date_in'];
                    $date_out = $_POST['date_out'];
                    $date_start_support = $_POST['date_start_support'];
                    $price = $_POST['price'];
                    $result = $project->updateProject("projects",
                        $domain,
                        $projectName,
                        $expert,
                        $problem_id,
                        $description,
                        $date_in,
                        $date_out,
                        $date_start_support,
                        $price,
                        $id
                    );
                    header("Location: projects.php");
                    exit();
                }
            
            ?>

        </div><!--/.fluid-container-->

    <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
<?php
ob_end_flush();