<?php
$data = fopen("http://www.vpngate.net/api/iphone/", "r");
if ($data) {
	fgets($data);
	fgets($data);
	$line = fgets($data);
	$configs = explode(",", $line);
	$vpnConfig = $configs[count($configs)-1];
	echo $vpnConfig;
}
