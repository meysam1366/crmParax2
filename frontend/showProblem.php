<?php
require_once '../core/core.php';
$problems = new dbTicket("support", "localhost", "root", "");

$problem = $problems->readAllTicket('problems');

var_dump($problem);