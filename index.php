<?php 

require_once('./vendor/autoload.php'); // Namespace 
require_once('./testc.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use LINE\LINEBot\Constant\MessageType;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$API_URL ='https://api.line/me/v2/bot/message';
$channel_token = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '47bc90719fa07a6a119bea4d462a29f6'; 



$dataR = curlData($channel_token, $json);

//curlImages($dataR->richMenuId, 'test', 'image.jpeg', $channel_token);

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
    $priceListName =[];
    foreach($getData['data'] as $val){
    $priceList[$val['symbol']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    $priceListName[$val['name']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    }
}

$coinprice = 'Coin Price';

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
             if(in_array( strtoupper($event['message']['text']), array_keys($priceList) ) ) {
                  $respMessage = $event['message']['text'].' -> '.$priceList[strtoupper($event['message']['text'])];
              }  
              
            
            if($event['message']['text']==$coinprice){
                $respMessageImg = '{
                "type": "bubble",
                "body": {
                "type": "box",
                "layout": "horizontal",
                "contents": [
                {
                "type": "text",
                "text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod\n tempor incididunt ut labore et dolore magna aliqua.",
                "wrap": true
                }
                ]
                }
                }';
                $respMessage = 'Please click the image above or insert coin symbol to see current price';
                  
              }         
              //else {
                //  $respMessage = 'Hello, your message is '. $event['message']['text'];
              //}
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
        //textMessage
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        // ImageMessage
        $TextMessageBuilder = new ImageMessageBuilder ($respMessageImg);
        $response = $bot->replyMessage($replyToken,$textMesssageBuilder);
        
    }
    
}

echo "OK";

?>