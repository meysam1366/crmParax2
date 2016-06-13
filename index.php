<?php
$path = '/support';
if(isset($_GET['url']) && $_GET['url'] == 'frontend') {
    header("Location: " . $path . '/frontend');
    exit();
}elseif (isset($_GET['url']) && $_GET['url'] == 'backend') {
    header("Location: " . $path . '/backend');
    exit();
}else {
    header("Location: " . $path . '/frontend');
    exit();
}
