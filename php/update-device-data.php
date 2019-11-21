<?php
include 'db.php';
$userID = $_POST["user_id"];
$deviceID = $_POST["device_id"];
$lastUpdate = intval($_POST["last_update"]);
$c->query("UPDATE users SET device_id='" . $deviceID . "', last_update=" . $lastUpdate . " WHERE id='" . $userID . "');
