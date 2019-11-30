<?php
include 'db.php';
$userID = $_POST["user_id"];
$externalID = $_POST["external_id"];
$amount = intval($_POST["amount"]);
$c->query("INSERT INTO xendit_purchases (user_id, external_id, amount, status) VALUES ('" . $userID . "', '" . $externalID . "', " . $amount . ", 0)");
