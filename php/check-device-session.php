<?php
include 'db.php';
$email = $_POST["email"];
$id = $c->query("SELECT * FROM users WHERE email='" . $email . "'")->fetch_assoc()["id"];
$lastUpdate = intval($_POST["last_update"]);
$deviceID = $_POST["device_id"];
$row = $c->query("SELECT * FROM users WHERE id='" . $id . "'")->fetch_assoc();
$distanceTime = $lastUpdate-intval($row["last_update"]);
//echo "Last update: " . $lastUpdate . ", last update (db): " . $row["last_update"] . ", distance time: " . $distanceTime;
//return;
if ($deviceID == $row["device_id"]) {
	$c->query("UPDATE users SET active_connections=1, device_id='" . $deviceID . "' WHERE id='" . $id . "'");
	echo 1;
	return;
}
if ($deviceID != $row["device_id"]) {
	if ($row["active_connections"] >= 1) {
		if ($distanceTime >= 5*60*1000) { //5 minutes
			$c->query("UPDATE users SET active_connections=1, device_id='" . $deviceID . "' WHERE id='" . $id . "'");
			echo 1;
		} else {
			echo -1;
		}
	} else {
		$c->query("UPDATE users SET active_connections=1, device_id='" . $deviceID . "' WHERE id='" . $id . "'");
		echo 1;
	}
	return;
}
