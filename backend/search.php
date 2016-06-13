<?php
require_once '../core/core.php';

$search = new dbUser("support", "localhost", "root", "");

$searchField = $_GET['term'];

    $result = $search->searchUser($searchField);

    $user = json_encode($result);

//    echo '<table>';
        echo $user;
//    echo '</table>';
