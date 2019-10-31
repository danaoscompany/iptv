<?php
$receiverRegistrationToken = $_POST["registration_token"];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/joss-player/messages:send");
$header = array();
$header[] = "Content-Type: application/json";
$header[] = "Authorization: Bearer " . $accessToken;
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($curl, CURLOPT_TIMEOUT, 60);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, '{"message":{"notification": {"title": "New message", "body": "This is message"},"token": "' . $receiverRegistrationToken . '", "data": {"type": "new_message"}}}');
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_exec($curl);
curl_close($curl);
