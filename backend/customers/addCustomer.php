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

$addDomain = new dbCustomer("support", "localhost", "root", "");

$users = new dbUser("support", "localhost", "root", "");

$sql = "SELECT * FROM `users` WHERE `role` = '{$_SESSION['Admin']}'";

$result = $users->readUser($sql);

$projects = new dbProject("support", "localhost", "root", "");

$project = $projects->readAllProject('projects');

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
                <a href="<?= BASE_DOMAIN; ?>/backend/customers/customers.php" class="btn btn-success">بازگشت</a>
                <div class="page-header">اضافه کردن مشتری جدید</div>
                <div class="container">
                    <form class="form-horizontal" action="" method="post">
                        <div class="control-group">
                            <input type="submit" name="add" id="add" class="btn btn-success" value="ثبت">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="telegram_id">آی دی تلگرام</label>
                            <input type="text" name="telegram_id" id="telegram_id" class="controls" value="@" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name">نام مشتری</label>
                            <input type="text" name="name" id="name" class="controls" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">ایمیل مشتری</label>
                            <input type="text" name="email" id="email" class="controls" required="نام و نام خانوادگی">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone">شماره مشتری</label>
                            <input type="text" name="phone" id="phone" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="username">نام کاربری</label>
                            <input type="text" name="username" id="username" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">رمز عبور</label>
                            <input type="password" name="password" id="password" class="controls" required title="ایمیل">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date">تاریخ</label>
                            <input type="text" name="date" id="date" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date_create_customer">تاریخ ایجاد مشتری</label>
                            <input type="text" name="date_create" id="date_create_customer" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="type_project">نوع مشتری</label>
                            <input type="text" name="type_project" id="type_project" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="note">یادداشت</label>
                            <textarea cols="5" rows="7" name="note" id="note" class="controls" required title="ایمیل"></textarea>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="company">نام شرکت</label>
                            <input type="text" name="company" id="company" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="connector">طرف حساب یا رابط</label>
                            <input type="text" name="connector" id="connector" class="controls" required title="نام کاربری">
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">آدرس</label>
                            <textarea cols="5" rows="7" name="address" id="address" class="controls" required title="ایمیل"></textarea>
                        </div>
                    </form>
                </div>

                <?php
                    if (isset($_POST['add'])) {
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
                        $result = $addDomain->createCustomer("customers",
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
                            $create_by
                        );

                        header("Location: customers.php");
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