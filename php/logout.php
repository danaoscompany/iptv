<?php
include 'db.php';
/*$ip = $_SERVER["REMOTE_ADDR"];
$c->query("DELETE FROM sessions WHERE ip='" . $ip . "'");*/
session_id("jossstream");
session_start();
//$userId = $_SESSION["jossstream_user_id"];
$userId = $_POST["user_id"];
$c->query("UPDATE users SET active_connections = 0 WHERE id='" . $userId . "'");
unset($_SESSION["jossstream_user_id"]);
session_destroy();
