<?php

// $API_URL = 'https://api.line.me/v2/bot/message';
// $ACCESS_TOKEN = 'wkLBbyb5keBNBpkEpai4FunmdNQ2cuIjWfZnbikThXQCy9pAUSv0ATqxmhxW3a6bBSeAjumNWi0k7eZpiDPKoW3C7mn/ODA1A4IPLS2eQIn6r+kVmHm9L0TIe1f+F6l3zCT5vFdzr0ZLpteAHZBMQAdB04t89/1O/w1cDnyilFU='; 
// $channelSecret = '698948a6edcc1641e1dc2360f7f6bcfd';
// $POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
// $request = file_get_contents('php://input');   // Get request content
// $request_array = json_decode($request, true);   // Decode JSON to Array

//set database
// $hostname = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// $link = mysqli_connect("$hostname", "$username", "$password")or die("cannot connect"); 
// mysqli_select_db($link, 'notify')or die("cannot select DB");

// $conn = new mysqli($hostname, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
// echo "Connected successfully";


// $strSQL = "SELECT * FROM 'res_notify' ";
// $objQuery = mysql_query($strSQL) or die (mysql_error());

   $url = $_REQUEST['tokenSourceURL'];
   echo "OK + ". $url;








// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// $result = curl_exec($ch);
// curl_close($ch);

// echo $result;

?>
