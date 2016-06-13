<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!$_SESSION['Customer']) {
    header("Location: login.php");
    exit();
}
require_once '../core/core.php';
$db = new dbProject("support", "localhost", "root", "");

$username = $_SESSION['Customer'];

$result = $db->joinCustomerProject($username);
//echo '<pre>';
//print_r($result);exit();
//echo '</pre>';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/bootstrap/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_DOMAIN; ?>/backend/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="addProblem.php" enctype="multipart/form-data" method="post" class="form-horizontal col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="title">عنوان</label>
                        <input type="text" name="title" id="title" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="project_name">نام پروژه</label>
                        <select name="project_name" id="project_name" class="form-control">
                            <?php
                            foreach ($result as $project) {
                                ?>
                                <option class="controls" value="<?= $project['id'] ?>"><?= $project['project_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات</label>
                        <textarea id="description" cols="5" rows="7" name="description" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="file">انتخاب عکس</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="ثبت" name="send" class="btn btn-large">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <?php
                    require_once SOFT_ROOT . '/frontend/sidebar.php';
                ?>
            </div>
        </div>
    </div>
</body>
</html>
