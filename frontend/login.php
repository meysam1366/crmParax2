<?php
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_SESSION['Customer'])) {
    header("Location: panel.php");
    exit();
}else {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $customer = new dbCustomer("support", "localhost", "root", "");
        $result = $customer->checkLoginCustomer('users', $username);

        //        echo '<pre>';
        //            print_r($result);
        //        echo '<pre>';

        //
        //        exit();

        if($result['username'] == $username && $result['password'] == $password) {
            $_SESSION['Customer'] = $result['username'];
            header("Location: panel.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مدیریت سامانه پشتیبانی پاراکس وب</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/form-elements.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= BASE_DOMAIN; ?>/backend/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= BASE_DOMAIN; ?>/backend/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= BASE_DOMAIN; ?>/backend/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= BASE_DOMAIN; ?>/backend/assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong> به مدیریت سامانه پشتیبانی پاراکس وب</strong> خوش آمدید</h1>
                    <div class="description">
                        <p>
                            <br><a href="http://www.paraxweb.com" title="پاراکس وب" target="_blank"><strong>پاراکس وب</strong></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left pull-right">
                            <h3 class="text-right">ورود به سامانه</h3>
                            <p class="text-right">برای ورود به سامانه لطفا نام کاربری و رمز عبور خود را وارد کنید:</p>
                        </div>
                        <div class="form-top-right pull-left">
                            <i class="fa fa-key"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="" method="post" class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">نام کاربری</label>
                                <input type="text" name="username" placeholder="نام کاربری ..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">رمز عبور</label>
                                <input type="password" name="password" placeholder="رمز عبور ..." class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" name="login" class="btn">ورود</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="<?= BASE_DOMAIN; ?>/backend/assets/js/jquery-1.11.1.min.js"></script>
<script src="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= BASE_DOMAIN; ?>/backend/assets/js/jquery.backstretch.min.js"></script>
<script src="<?= BASE_DOMAIN; ?>/backend/assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="<?= BASE_DOMAIN; ?>/backend/assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>