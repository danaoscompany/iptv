<?php
include 'db.php';
$reportData = file_get_contents("php://input");
$c->query("INSERT INTO reports (data) VALUES ('" . $reportData . "')");
file_put_contents($reportData, "report.json");