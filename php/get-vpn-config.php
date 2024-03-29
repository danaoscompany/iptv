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
			$country = $configs[5];
			if ($speed != 0 && $speed >= 50000000 && $country != "United Kingdom" && $country != "United States") {
				$vpnConfig = $configs[count($configs)-1];
				$server = array(
					"country" => $country,
					"ip" => $configs[1],
					"speed" => $speed,
					"config" => $vpnConfig
				);
				//echo "Country: " . $configs[5] . ", IP: " . $configs[1] . ", speed: " . $configs[4] . "<br/>";
				array_push($servers, $server);
			}
		}
	}
	usort($servers, function($a, $b) {
		return $a["speed"] > $b["speed"] ? -1 : 1;
	});
	//echo "Fastest country: " . $servers[0]["country"] . ", IP: " . $servers[0]["ip"] . ", speed: " . $servers[0]["speed"] . "<br/>";
	//echo json_encode($servers[0]);
	echo json_encode($servers[rand(0, count($servers)-1)]);
} else {
	echo -1;
}
