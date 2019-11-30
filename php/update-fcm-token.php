<?php
include 'db.php';
$userID = $_POST["user_id"];
$token = $_POST["token"];
$c->query("UPDATE users SET fcm_id='" . $token . "' WHERE id='" . $userID . "'");
