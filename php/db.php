<?php
$c = new mysqli("localhost", "iptc8859_admin", "HelloWorld@123");
$c->select_db("iptc8859_iptv");
echo "Connect error: " . $c->connect_error . "\n";
if ($c) {
	echo "Connection succeed\n";
} else {
	echo "Connection error\n";
}
