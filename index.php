<?php 

require_once('./vendor/autoload.php'); // Namespace 
require_once('./testc.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$channel_token = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '47bc90719fa07a6a119bea4d462a29f6'; 

// James' API
//$getData = json_decode(file_get_contents('http://192.168.10.241:5000/api/fromDB'), TRUE);
$getData = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10'), TRUE);

// James' DB
//if(!empty($getData['DB'])) {
//    $priceList = [];
//    foreach($getData['DB'] as $val) {
//    $priceList[$val['symbol']] = 'Price: ' . $val['quotes']['USD']['price'] . 'USD ' .$val['quotes']['THB']['price'] . ' THB';  
//    }
//}


if(!empty($getData['data'])){
    $priceList =[];
    foreach($getData['data'] as $val){
    $priceList[$val['symbol']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    }
}


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
              
      switch($event['message']['type']) { 
            case 'text': 
              //if($event['message']['text']=="Current Coin Price")
              if(in_array( strtoupper($event['message']['text']), array_keys($priceList) )) {
                  $respMessage = $priceList[strtoupper($event['message']['text'])];
              }else {
                  $respMessage = 'Hello, your message is '. $event['message']['text'];
              }
              //  $respMessage = getdata();
                break;
                default:
                //Reply message
                $respMessage='What a nice day!';
                break;
            }
                                         }
        else if($event['type']=='follow'){     
            // Greeting 
            $respMessage = 'Thank you. I try to be your best friend.'; 
            
       
        }
        $httpClient = new CurlHTTPClient($channel_token); 
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    }
    
} 



function uploadImageRichmenu ($channelAccessToken){
  $sh = <<< EOF
  curl -X POST \
  -H 'Authorization: Bearer $channelAccessToken' \
  -H 'Content-Type: image/jpeg' \
  -T image.jpg \
  https://api.line.me/v2/bot/richmenu/{richMenuID}/content
EOF;
  // $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  // if(isset($result['message'])) {
  //   return $result['message'];

}


function createNewRichmenu($channelAccessToken) {
    $sh = <<< EOF
    curl -X POST \
    -H 'Authorization: Bearer $channelAccessToken' \
    -H 'Content-Type:application/json' \
    -d '{
    "size": {
    "width": 2500,
    "height": 1686
            },
    "selected": true,
    "name": "CryptoCurrency Page",
    "chatBarText": "CryptoCurrency",
    "areas": [
      {
      "bounds": {
        "x": 0,
        "y": 0,
        "width": 833,
        "height": 843
        },
      "action": {
        "type": "message",
        "text": "BTC"
        }
      },
      {
      "bounds": {
        "x": 834,
        "y": 0,
        "width": 833,
        "height": 843
        },
      "action": {
        "type": "message",
        "text": "ADA"
        }
      },
      {
      "bounds": {
        "x": 1667,
        "y": 0,
        "width": 833,
        "height": 843
      },
      "action": {
        "type": "message",
        "text": "ETH"
        }
      },
      {
      "bounds": {
        "x": 0,
        "y": 843,
        "width": 833,
        "height": 843
      },
      "action": {
        "type": "message",
        "text": "OMG"
        }
      },
      {
      "bounds": {
        "x": 834,
        "y": 843,
        "width": 833,
        "height": 843
      },
      "action": {
        "type": "message",
        "text": "EOH"
        }
      },
      {
      "bounds": {
        "x": 1667,
        "y": 843,
        "width": 833,
        "height": 843
      },
      "action": {
        "type": "message",
        "text": "XRP"
        }
      }
    ]
    }'
EOF;
  //  $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
  // if(isset($result['richMenuId'])) {
  //   return $result['richMenuId'];
  // }
  // else {
  //   return $result['message'];

}

echo "OK";

?>