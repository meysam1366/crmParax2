<?php
echo 'x';
require_once '../core/core.php';
if (!isset($_SESSION)) {
    session_start();
}
    unset($_SESSION['Customer']);
    session_destroy();
    header("Location: login.php");
    exit();
