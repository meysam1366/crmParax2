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

$project = new dbProject("support", "localhost", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $project->deleteProject("projects", $id);
    header("Location: projects.php");
    exit();
}

ob_end_flush();