<?php

<<<<<<< HEAD
 $API_URL = 'https://api.line.me/v2/bot/message';
 $Multicast = 'https://api.line.me/v2/bot/message/multicast';
 $ACCESS_TOKEN = 'wkLBbyb5keBNBpkEpai4FunmdNQ2cuIjWfZnbikThXQCy9pAUSv0ATqxmhxW3a6bBSeAjumNWi0k7eZpiDPKoW3C7mn/ODA1A4IPLS2eQIn6r+kVmHm9L0TIe1f+F6l3zCT5vFdzr0ZLpteAHZBMQAdB04t89/1O/w1cDnyilFU='; 
 $channelSecret = '698948a6edcc1641e1dc2360f7f6bcfd';
 $POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
 $request = file_get_contents('php://input');   // Get request content
 $request_array = json_decode($request, true);   // Decode JSON to Array

// if($connection){
//     echo "Connected ";
// }


$headers = array('Authorization: Bearer ' . $ACCESS_TOKEN);
$url = 'https://api.line.me/v1/oauth/verify';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

// $message = $POST['message'];
// send_reply_message($url, $post_header, $message);



//echo "OK";
// function send_reply_message($url, $post_header, $post_body)
// {
//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }
=======
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'wkLBbyb5keBNBpkEpai4FunmdNQ2cuIjWfZnbikThXQCy9pAUSv0ATqxmhxW3a6bBSeAjumNWi0k7eZpiDPKoW3C7mn/ODA1A4IPLS2eQIn6r+kVmHm9L0TIe1f+F6l3zCT5vFdzr0ZLpteAHZBMQAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '698948a6edcc1641e1dc2360f7f6bcfd';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if($connection){
    echo "Connected ";
}

$message = $POST['message'];
send_reply_message(url, $post_header, $message);


//echo "OK";
function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
>>>>>>> a09e69268554618337df0259cdd725e088e0a46b
?>
