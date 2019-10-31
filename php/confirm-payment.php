<?php
include 'db.php';
$data = file_get_contents("php://input");
$obj = json_decode($data);
$externalID = $obj["external_id"];
$row = $c->query("SELECT * FROM payments WHERE external_id='" . $externalID . "'")->fetch_assoc();
$userID = $row["id"];
$receiverRegistrationToken = $c->query("SELECT * FROM users WHERE id='" . $userID . "'")->fetch_assoc()["fcm_id"];
$month = intval($row["month"]);
$c->query("UPDATE payments SET status=1 WHERE external_id='" . $externalID . "'");
$endDate = intval($c->query("SELECT * FROM users WHERE id='" . $userID . "'")->fetch_assoc()["end_date"]);
$endDate += ($month*30*24*60*60*1000);
$c->query("UPDATE users SET end_date=" . $endDate . " WHERE id='" . $userID . "'");
$url = 'https://fcm.googleapis.com/fcm/send';
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AAAAQ0HaK2k:APA91bFS-FA9qbzC7AQ25VJS9W_9vaO5yLPd9XcbaNwaFCvpROH8J1Tu8QEDNKdS8joA49QSg0v6YsaZR2-fcE_yHm4smeqmIAPXQXdRmhzue4zg-768pNbDdj3X4Ewwz67yGKvkCua0';

$notification = array('title' =>"Akun Anda telah diperbarui" , 'body' => "Akun akan aktif " . $month . " bulan ke depan", 'sound' => 'default', 'badge' => '1');
$data = array('to' => $receiverRegistrationToken, 'notification' => $notification,'priority'=>'high', 'data'=>array(
        "type"=>"account_upgraded"
        ));
//header with content_type api key
$headers = array(
	'Content-Type:application/json',
  'Authorization:key='.$server_key
);
			
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
} else {
	echo "Success\n";
}
curl_close($ch);
