<?php require_once('./vendor/autoload.php'); // Namespace 
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$channel_token = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '47bc90719fa07a6a119bea4d462a29f6'; 

// Get message from Line API 

$content = file_get_contents('php://input'); $events = json_decode($content, true); 

if (!is_null($events['events'])) { 
    // Loop through each event 
    foreach ($events['events'] as $event) { 
        // Line API send a lot of event type, we interested in message only. 
        if ($event['type'] == 'message') { switch($event['message']['type']) { 
                case 'text': // Get replyToken 
                $replyToken = $event['replyToken']; // Reply message 
                $respMessage = 'Hello, your message is '. $event['message']['text'];
                $httpClient = new CurlHTTPClient($channel_token); 
                $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
                $textMessageBuilder = new TextMessageBuilder($respMessage);
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                break; }
                                         }
    }
} 
echo "OK";