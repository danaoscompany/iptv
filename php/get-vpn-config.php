<?php
$data = fopen("http://www.vpngate.net/api/iphone/", "r");
$servers = [];
if ($data) {
	fgets($data);
	fgets($data);
	/*$line = fgets($data);
	$configs = explode(",", $line);
	$vpnConfig = $configs[count($configs)-1];
	echo $vpnConfig;*/
	while (($line = fgets($data)) !== false) {
		if (strpos($line, '*') === false) {
			$configs = explode(",", $line);
			$speed = intval($configs[4]);
			$vpnConfig = $configs[count($configs)-1];
			$server = array(
				"country" => $configs[5],
				"ip" => $configs[1],
				"speed" => $speed,
				"config" => $vpnConfig
			);
			//echo "Country: " . $configs[5] . ", IP: " . $configs[1] . ", speed: " . $configs[4] . "<br/>";
			array_push($servers, $server);
		}
	}
	usort($servers, function($a, $b) {
		return $a["speed"] > $b["speed"] ? -1 : 1;
	});
	//echo "Fastest country: " . $servers[0]["country"] . ", IP: " . $servers[0]["ip"] . ", speed: " . $servers[0]["speed"] . "<br/>";
	echo json_encode($servers[0]);
} else {
	echo -1;
}
