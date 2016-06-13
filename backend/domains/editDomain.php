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

$domains = new dbDomain("support", "localhost", "root", "");

$user = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `id` = '{$id}'";

$result = $user->readUser($sql);

$s = "SELECT * FROM `website` WHERE `id` = $id";

$domain = $domains->readDomain($s);

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
            <a href="<?= BASE_DOMAIN; ?>/backend/domains/domains.php" class="btn btn-success">بازگشت</a>
            <div class="page-header">ویرایش اطلاعات دامنه</div>
            <div class="container">
                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <label class="control-label" for="DomainName">نام دامنه</label>
                        <input type="text" name="DomainName" id="DomainName" class="controls" value="<?= $domain['domain_name'] ?>" required="نام و نام خانوادگی">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="DomainUrl">آدرس دامنه</label>
                        <input type="text" name="DomainUrl" id="DomainUrl" class="controls" value="<?= $domain['domain_url'] ?>" required="نام و نام خانوادگی">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="user_panel">نام کاربری پنل</label>
                        <input type="text" name="user_panel" id="user_panel" class="controls" value="<?= $domain['user_panel'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pass_panel">رمز عبور پنل</label>
                        <input type="password" name="pass_panel" id="pass_panel" class="controls" value="<?= $domain['pass_panel'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="domain_price">هزینه دامنه</label>
                        <input type="text" name="domain_price" id="domain_price" class="controls" value="<?= $domain['domain_price'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="domain_date_start">تاریخ شروع دامنه</label>
                        <input type="text" name="domain_date_start" id="domain_date_start" class="controls" value="<?= $domain['domain_date_start'] ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="domain_date_expired">تاریخ انقضای دامنه</label>
                        <input type="text" name="domain_date_expired" id="domain_date_expired" class="controls" value="<?= $domain['domain_date_expired'] ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="host_price">هزینه هاست</label>
                        <input type="text" name="host_price" id="host_price" class="controls" value="<?= $domain['host_price'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="host_date_start">تاریخ شروع هاست</label>
                        <input type="text" name="host_date_start" id="host_date_start" class="controls" value="<?= $domain['host_date_start'] ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="host_date_expired">تاریخ انقضای هاست</label>
                        <input type="text" name="host_date_expired" id="host_date_expired" class="controls" value="<?= $domain['host_date_expired'] ?>" required title="نام کاربری">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name_domain_site">نام ادمین سایت</label>
                        <input type="text" name="name_domain_site" id="name_domain_site" class="controls" value="<?= $domain['name_admin_site'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="phone_domain_site">شماره ادمین سایت</label>
                        <input type="text" name="phone_domain_site" id="phone_domain_site" class="controls" value="<?= $domain['phone_admin_site'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email_domain_site">ایمیل ادمین سایت</label>
                        <input type="text" name="email_domain_site" id="email_domain_site" class="controls" value="<?= $domain['email_admin_site'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="user_social_network">نام کاربری شبکه های اجتماعی</label>
                        <input type="text" name="user_social_network" id="user_social_network" class="controls" value="<?= $domain['user_social_network'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pass_social_network">رمز عبور شبکه های اجتماعی</label>
                        <input type="password" name="pass_social_network" id="pass_social_network" class="controls" value="<?= $domain['pass_social_network'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="user_weblog">نام کاربری وبلاگ</label>
                        <input type="text" name="user_weblog" id="user_weblog" class="controls" value="<?= $domain['user_weblog'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pass_weblog">رمز عبور وبلاگ</label>
                        <input type="password" name="pass_weblog" id="pass_weblog" class="controls" value="<?= $domain['pass_weblog'] ?>" required title="ایمیل">
                    </div>
                    <div class="control-group">
                        <input type="submit" name="edit" id="edit" class="btn btn-success" value="ثبت">
                    </div>
                </form>
            </div>

            <?php
                if (isset($_POST['edit'])) {
                    $id = intval($_GET['id']);
                    $DomainName = $_POST['DomainName'];
                    $DomainUrl = $_POST['DomainUrl'];
                    $user_panel = $_POST['user_panel'];
                    $pass_panel = md5($_POST['pass_panel']);
                    $domain_price = $_POST['domain_price'];
                    $domain_date_start = $_POST['domain_date_start'];
                    $domain_date_expired = $_POST['domain_date_expired'];
                    $host_price = $_POST['host_price'];
                    $host_date_start = $_POST['host_date_start'];
                    $host_date_expired = $_POST['host_date_expired'];
                    $name_domain_site = $_POST['name_domain_site'];
                    $phone_domain_site = $_POST['phone_domain_site'];
                    $email_domain_site = $_POST['email_domain_site'];
                    $user_social_network = $_POST['user_social_network'];
                    $pass_social_network = md5($_POST['pass_social_network']);
                    $user_weblog = $_POST['user_weblog'];
                    $pass_weblog = md5($_POST['pass_weblog']);
                    $result = $domains->updateDomain("website",
                        $DomainName,
                        $DomainUrl,
                        $user_panel,
                        $pass_panel,
                        $domain_price,
                        $domain_date_start,
                        $domain_date_expired,
                        $host_price,
                        $host_date_start,
                        $host_date_expired,
                        $name_domain_site,
                        $phone_domain_site,
                        $email_domain_site,
                        $user_social_network,
                        $pass_social_network,
                        $user_weblog,
                        $pass_weblog,
                        $id
                    );

                    header("Location: domains.php");
                    exit();
                }
            
            ?>

        </div><!--/.fluid-container-->

        <?php require_once SOFT_ROOT . '/backend/footer.php'; ?>
<?php
ob_end_flush();