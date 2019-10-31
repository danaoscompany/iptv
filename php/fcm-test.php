<?php
$receiverRegistrationToken = $_POST["registration_token"];
//FCM api URL
$url = 'https://fcm.googleapis.com/fcm/send';
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AAAAQ0HaK2k:APA91bFS-FA9qbzC7AQ25VJS9W_9vaO5yLPd9XcbaNwaFCvpROH8J1Tu8QEDNKdS8joA49QSg0v6YsaZR2-fcE_yHm4smeqmIAPXQXdRmhzue4zg-768pNbDdj3X4Ewwz67yGKvkCua0';

$notification = array('title' =>"This is title" , 'body' => "This is text", 'sound' => 'default', 'badge' => '1');
$data = array('to' => $token, 'notification' => $notification,'priority'=>'high', 'data'=>'{\"type\": \"new_message\"}');
			
$fields = array();
$fields['data'] = $data;
$fields['to'] = $receiverRegistrationToken;
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
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
} else {
	echo "Success\n";
}
curl_close($ch);
