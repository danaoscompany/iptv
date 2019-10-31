<?php
include 'db.php';
$data = file_get_contents("php://input");
$obj = json_decode($data);
$externalID = $obj["external_id"];
$c->query("UPDATE payments SET status=1 WHERE external_id='" . $externalID . "'");

