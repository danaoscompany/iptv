<?php
session_id("jossstream");
session_start();
$userId = $_SESSION["jossstream_user_id"];
echo $userId;
