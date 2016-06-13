<?php

require_once '../core/core.php';
$tickets = new dbTicket("support", "localhost", "root", "");

$id = intval($_GET['id']);
$ticket = $tickets->deleteTicket('tickets', $id);

header("Location: panel.php");
exit();

