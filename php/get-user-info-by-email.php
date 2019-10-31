<?php
include 'db.php';
$results = $c->query("SELECT * FROM `users` WHERE email='danaoscompany@gmail.com'");
if ($results && $results->num_rows > 0) {
    echo json_encode($results->fetch_assoc());
} else {
    echo -1;
}
