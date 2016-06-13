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

$addDomain = new dbDomain("support", "localhost", "root", "");

$users = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $users->readUser($sql);

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

//            $conn = new PDO("mysql:host=localhost;dbname=support;charset=utf8;", "root", "root");
//            $sql = "SELECT * FROM users WHERE `role` = 'Admin'";
//            $query = $conn->prepare($sql);
//            $query->execute();
//            $result = $query->fetchAll();
//            var_dump($result);
//            exit();
            ?>

            <!-- start: Content -->
            <div id="content" class="span10">
                <a href="<?= BASE_DOMAIN; ?>/backend/domains/domains.php" class="btn btn-success">بازگشت</a>
                <div class="page-header">اضافه کردن دامنه جدید</div>
                <div class="container">
                    <form class="form-horizontal" action="" method="post">
                        <div class="control-group">
                            <label class="control-label" for="DomainName">نام دامنه</label>
                            <input type="text" name="DomainName" id="DomainName" class="controls" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="DomainUrl">آدرس دامنه</label>
                            <input type="text" name="DomainUrl" id="DomainUrl" class="controls" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="user_panel">نام کاربری پنل</label>
                            <input type="text" name="user_panel" id="user_panel" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pass_panel">رمز عبور پنل</label>
                            <input type="password" name="pass_panel" id="pass_panel" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="domain_price">هزینه دامنه</label>
                            <input type="text" name="domain_price" id="domain_price" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="domain_date_start">تاریخ شروع دامنه</label>
                            <input type="text" name="domain_date_start" id="domain_date_start" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="domain_date_expired">تاریخ انقضای دامنه</label>
                            <input type="text" name="domain_date_expired" id="domain_date_expired" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="host_price">هزینه هاست</label>
                            <input type="text" name="host_price" id="host_price" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="host_date_start">تاریخ شروع هاست</label>
                            <input type="text" name="host_date_start" id="host_date_start" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="host_date_expired">تاریخ انقضای هاست</label>
                            <input type="text" name="host_date_expired" id="host_date_expired" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name_domain_site">نام ادمین سایت</label>
                            <input type="text" name="name_domain_site" id="name_domain_site" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone_domain_site">شماره ادمین سایت</label>
                            <input type="text" name="phone_domain_site" id="phone_domain_site" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email_domain_site">ایمیل ادمین سایت</label>
                            <input type="text" name="email_domain_site" id="email_domain_site" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="user_social_network">نام کاربری شبکه های اجتماعی</label>
                            <input type="text" name="user_social_network" id="user_social_network" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pass_social_network">رمز عبور شبکه های اجتماعی</label>
                            <input type="password" name="pass_social_network" id="pass_social_network" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="user_weblog">نام کاربری وبلاگ</label>
                            <input type="text" name="user_weblog" id="user_weblog" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pass_weblog">رمز عبور وبلاگ</label>
                            <input type="password" name="pass_weblog" id="pass_weblog" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <input type="submit" name="add" id="add" class="btn btn-success" value="ثبت">
                        </div>
                    </form>
                </div>

                <?php
                    if (isset($_POST['add'])) {
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
                        $result = $addDomain->createDomain("website",
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
                            $pass_weblog
                        );

                        header("Location: domains.php");
                        exit();
                    }
//                ?>

            </div><!--/.fluid-container-->

            <!-- end: Content -->
        </div><!--/#content.span10-->
    </div><!--/fluid-row-->

    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>

    <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <ul class="list-inline item-details">
                <li><a href="http://themifycloud.com">Admin templates</a></li>
                <li><a href="http://themescloud.org">Bootstrap themes</a></li>
            </ul>
        </div>
    </div>

    <div class="clearfix"></div>

    <footer>

        <p>
            <span style="text-align:left;float:left">&copy; 2013 <a href="http://themifycloud.com/downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>

        </p>

    </footer>

    <!-- start: JavaScript-->

    <script src="../../backend/assets/js/jquery-1.9.1.min.js"></script>
    <script src="../../backend/assets/js/jquery-migrate-1.0.0.min.js"></script>

    <script src="../../backend/assets/js/jquery-ui-1.10.0.custom.min.js"></script>

    <script src="../../backend/assets/js/jquery.ui.touch-punch.js"></script>

    <script src="../../backend/assets/js/modernizr.js"></script>

    <script src="../../backend/assets/js/bootstrap.min.js"></script>

    <script src="../../backend/assets/js/jquery.cookie.js"></script>

    <script src='../../backend/assets/js/fullcalendar.min.js'></script>

    <script src='../../backend/assets/js/jquery.dataTables.min.js'></script>

    <script src="../../backend/assets/js/excanvas.js"></script>
    <script src="../../backend/assets/js/jquery.flot.js"></script>
    <script src="../../backend/assets/js/jquery.flot.pie.js"></script>
    <script src="../../backend/assets/js/jquery.flot.stack.js"></script>
    <script src="../../backend/assets/js/jquery.flot.resize.min.js"></script>

    <script src="../../backend/assets/js/jquery.chosen.min.js"></script>

    <script src="../../backend/assets/js/jquery.uniform.min.js"></script>

    <script src="../../backend/assets/js/jquery.cleditor.min.js"></script>

    <script src="../../backend/assets/js/jquery.noty.js"></script>

    <script src="../../backend/assets/js/jquery.elfinder.min.js"></script>

    <script src="../../backend/assets/js/jquery.raty.min.js"></script>

    <script src="../../backend/assets/js/jquery.iphone.toggle.js"></script>

    <script src="../../backend/assets/js/jquery.uploadify-3.1.min.js"></script>

    <script src="../../backend/assets/js/jquery.gritter.min.js"></script>

    <script src="../../backend/assets/js/jquery.imagesloaded.js"></script>

    <script src="../../backend/assets/js/jquery.masonry.min.js"></script>

    <script src="../../backend/assets/js/jquery.knob.modified.js"></script>

    <script src="../../backend/assets/js/jquery.sparkline.min.js"></script>

    <script src="../../backend/assets/js/counter.js"></script>

    <script src="../../backend/assets/js/retina.js"></script>

    <script src="../../backend/assets/js/custom.js"></script>
    <script src="../../backend/assets/js/persian-date-0.1.8.min.js"></script>
    <script src="../../backend/assets/js/persian-datepicker-0.4.5.min.js"></script>
    <script src="../../backend/assets/js/main.js"></script>
    <!-- end: JavaScript-->

    </body>
    </html>
<?php
ob_end_flush();