<?php
include 'db.php';
$data = file_get_contents("php://input");
$obj = json_decode($data);
$externalID = $obj["external_id"];
$c->query("UPDATE payments SET status=1 WHERE external_id='" . $externalID . "'");
//FCM API end-point
$url = 'https://fcm.googleapis.com/fcm/send';
//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AAAAQ0HaK2k:APA91bFS-FA9qbzC7AQ25VJS9W_9vaO5yLPd9XcbaNwaFCvpROH8J1Tu8QEDNKdS8joA49QSg0v6YsaZR2-fcE_yHm4smeqmIAPXQXdRmhzue4zg-768pNbDdj3X4Ewwz67yGKvkCua0';
//header with content_type api key
$headers = array(
    'Content-Type:application/json',
    'Authorization:key='.$server_key
);
//CURL request to route notification to FCM connection server (provided by Google)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
if ($result === FALSE) {
    die('Oops! FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
