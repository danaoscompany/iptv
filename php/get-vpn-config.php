<?php
$data = fopen("http://www.vpngate.net/api/iphone/", "r");
$servers = [];
if ($data) {
	fgets($data);
	fgets($data);
	while (($line = fgets($data)) !== false) {
		$configs = explode(",", $line);
		$speed = intval($configs[4]);
		$vpnConfig = $configs[count($configs)-1];
		echo $vpnConfig;
		return;
		$server = array(
			"speed" => $speed,
			"config" => $vpnConfig
		);
		array_push($servers, $server);
	}
	usort($servers, function($a, $b) {
		return $a["speed"] > $b["speed"] ? -1 : 1;
	});
	echo $servers[0]["config"];
} else {
	echo -1;
}
