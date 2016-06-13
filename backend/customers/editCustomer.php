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

$customers = new dbCustomer("support", "localhost", "root", "");

$user = new dbUser("support", "localhost", "root", "");

$projects = new  dbProject("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $user->readUser($sql);

$s = "SELECT * FROM `customers` WHERE `id` = '{$id}'";

$customer = $customers->readCustomer($s);

$project = $projects->readAllProject('projects');

//echo '<pre dir="ltr">';
//print_r($customer);

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
            <a href="<?= BASE_DOMAIN; ?>/backend/customers/customers.php" class="btn btn-success">بازگشت</a>
            <div class="page-header">ویرایش اطلاعات مشتری</div>
            <div class="container">
                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <input type="submit" name="edit" id="edit" class="btn btn-success" value="ویرایش">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="project_id">نام پروژه</label>
                        <select name="project_id" id="project_id">
                            <?php
                            foreach ($project as $p) {
                                ?>
                                <option value="<?= $p['id']; ?>"><?= $p['project_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="telegram_id">آی دی تلگرام</label>
                        <input type="text" name="telegram_id" id="telegram_id" class="controls" value="<?= $customer['telegram_id']; ?>" required="نام و نام خانوادگی">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name">نام مشتری</label>
                        <input type="text" name="name" id="name" class="controls" value="<?= $customer['name']; ?>" required="نام و نام خانوادگی">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">ایمیل مشتری</label>
                        <input type="text" name="email" id="email" class="controls" value="<?= $customer['email']; ?>" required="نام و نام خانوادگی">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="phone">شماره مشتری</label>
                        <input type="text" name="phone" id="phone" class="controls" value="<?= $customer['phone']; ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="username">نام کاربری</label>
                        <input type="text" name="username" id="username" class="controls" value="<?= $customer['username']; ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">رمز عبور</label>
                        <input type="password" name="password" id="password" class="controls" value="<?= $customer['password']; ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date">تاریخ</label>
                        <input type="text" name="date" id="date" class="controls" value="<?= $customer['date']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date_create_customer">تاریخ ایجاد مشتری</label>
                        <input type="text" name="date_create" id="date_create_customer" class="controls" value="<?= $customer['date_create']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="type_project">نوع مشتری</label>
                        <input type="text" name="type_project" id="type_project" class="controls" value="<?= $customer['type_project']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="note">یادداشت</label>
                        <textarea cols="5" rows="7" name="note" id="note" class="controls"required title="ایمیل"><?=  $customer['note']; ?></textarea>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="company">نام شرکت</label>
                        <input type="text" name="company" id="company" class="controls" value="<?= $customer['company']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="connector">طرف حساب یا رابط</label>
                        <input type="text" name="connector" id="connector" class="controls" value="<?= $customer['connector']; ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">آدرس</label>
                        <textarea cols="5" rows="7" name="address" id="address" class="controls" required title="ایمیل"><?= $customer['address']; ?></textarea>
                    </div>
                </form>
            </div>

            <?php
                if (isset($_POST['edit'])) {
                    $id = intval($_GET['id']);
                    $project_id = $_POST['project_id'];
                    $telegram_id = $_POST['telegram_id'];
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $date = $_POST['date'];
                    $date_create = $_POST['date_create'];
                    $type_project = $_POST['type_project'];
                    $note = nl2br($_POST['note']);
                    $company = $_POST['company'];
                    $connector = $_POST['connector'];
                    $address = nl2br($_POST['address']);
                    $create_by = $result['name'];
                    $results = $customers->updateCustomer("customers",
                        $project_id,
                        $telegram_id,
                        $name,
                        $email,
                        $phone,
                        $username,
                        $password,
                        $date,
                        $type_project,
                        $note,
                        $company,
                        $connector,
                        $address,
                        $date_create,
                        $create_by,
                        $id
                    );
//                    var_dump($result);exit();
                    header("Location: customers.php");
                    exit();
                }
            
            ?>

        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
<?php
ob_end_flush();