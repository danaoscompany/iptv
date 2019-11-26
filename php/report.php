<?php
include 'db.php';
$reportData = file_get_contents("php://input");
$reportData = json_decode($reportData, true)["STACK_TRACE"];
$c->query("INSERT INTO reports (data) VALUES ('" . $reportData . "')");
file_put_contents("report.json", $reportData);