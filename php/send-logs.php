<?php
include 'db.php';
$logs = file_get_contents("php://input");
$c->query("INSERT INTO logs (android_id, logs) VALUES ('" . uniqid() . "', '" . $logs . "')");
