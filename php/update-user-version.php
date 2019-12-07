<?php
include 'db.php';
$userID = $_POST["user_id"];
$lastVersion = intval($_POST["last_version"]);
$c->query("UPDATE users SET current_channel_version=" . $lastVersion . " WHERE id='" . $userID . "'");
