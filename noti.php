<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'wkLBbyb5keBNBpkEpai4FunmdNQ2cuIjWfZnbikThXQCy9pAUSv0ATqxmhxW3a6bBSeAjumNWi0k7eZpiDPKoW3C7mn/ODA1A4IPLS2eQIn6r+kVmHm9L0TIe1f+F6l3zCT5vFdzr0ZLpteAHZBMQAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '698948a6edcc1641e1dc2360f7f6bcfd';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if($connection){
    echo "Connected ";
}

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $ACCESS_TOKEN);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>
