<?php 

require_once('./vendor/autoload.php'); // Namespace 
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$channel_token = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 

$apipush = 'https://api.line.me/v2/bot/message/push';
$channel_secret = '47bc90719fa07a6a119bea4d462a29f6'; 

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

// Get message from Line API 

$content = file_get_contents('php://input');
$events = json_decode($content, true); 

if (!is_null($events['events'])) { 
    // Loop through each event 
    foreach ($events['events'] as $event) { 
       // Get replyToken 
        $replyToken = $event['replyToken']; 
        $ask = $event['message']['text'];
        
        if ($event['type'] == 'message') { 
              
//        switch($event['message']['type']) { 
//            case 'text': 
//                $respMessage = 'Hello, your message is '. $event['message']['text'];
//                break;
//            case 'tel':
//                $respMessage = '11223344';
//                break;
//            case 'address':
//                $respMessage = 'Mars';
//                break;
//            case 'boss tel':
//                $respMesage = 'Hihihi';
//                break;
//            case 'idcard':
//                $respMessage = '1234567789';
//                break;
//             case 'image':
//                    $messageID = $event['message']['id'];
//                    // Create image on server.
//                    $fileID = $event['message']['id'];
//                    $response = $bot->getMessageContent($fileID);
//                    $fileName = 'linebot.jpg';
//                    $file = fopen($fileName, 'w');
//                    fwrite($file, $response->getRawBody());
//                    // Reply message
//                    $respMessage = 'Hello, your image ID is '. $messageID;
//                    break;
//                default:
//                //Reply message
//                $respMessage='What a nice day!';
//                break;
//            }
//                                         }
//        else if($event['type']=='follow'){     
//            // Greeting 
//            $respMessage = 'Thanks you. I try to be your best friend.'; 
            
            $respMessage = '{  
 "type": "flex",
 "altText": "this is a flex message",
 "contents": {
   "type": "bubble",
   "body": {
     "type": "box",
     "layout": "vertical",
     "contents": [
       {
         "type": "text",
         "text": "hello"
       },
       {
         "type": "text",
         "text": "world"
       }
     ]
   }
 }
}';
        }
        $httpClient = new CurlHTTPClient($channel_token); 
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    }
    
} 
echo "OK";