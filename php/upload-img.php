<?php
include 'db.php';
/*$ip = $_SERVER["REMOTE_ADDR"];
$userId = $c->query("SELECT * FROM sessions WHERE ip='" . $ip . "'")->fetch_assoc()["user_id"];*/
session_id("jossstream");
session_start();
//$userId = $_SESSION["jossstream_user_id"];
$userId = $_POST["user_id"];
$results = $c->query("SELECT * FROM users WHERE id='" . $userId . "'");
$imgFileName = $_POST["img-file-name"];
move_uploaded_file($_FILES["img-file"]["tmp_name"], "../userdata/imgs/" . $imgFileName);