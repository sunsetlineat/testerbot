<?php
require_once('./vendor/autoload.php'); // Namespace 
require_once('./testc.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use LINE\LINEBot\Constant\MessageType;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU=';  
$channelSecret = '47bc90719fa07a6a119bea4d462a29f6';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

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



if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                
                $text = $event['message']['text'];
                if( $text == 'สวัสดี') {
                    $reply_message = 'สวัสดีนายท่าน ';
  //$reply_message = iconv("tis-620","utf-8",$reply_message);
            $data = [
                'replyToken' => $reply_token,
                // 'messages' => [['type' => 'text', 'text' => $reply_message]]
                'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
            $data = [
                'to' => $event['source']['userId'],
                'messages' => [
                    [
                        'type' => 'flex', 
                        'altText' => 'This is a Flex Message',
                        'contents'  =>  [
                            'type'  =>  'bubble',
                            'hero'  =>  [
                                'type'  =>  'image',
                                'url'   =>  'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_3_movie.png',
                                'size'  =>  'full',
                                'aspectRatio'   =>  '20:13',
                                'aspectMode'    =>  'cover',
                                'action'    =>  [
                                    'type'  =>  'uri',
                                    'uri'   =>  'https://bitkub.com'
                                ]
                            ],
                            'body'  =>  [
                                'type'  =>  'box',
                                'layout'    =>  'horizontal',
                                'contents'  =>  [
                                    [
                                        'type'  =>  'text',
                                        'text'  =>  'Hello,'
                                    ],
                                    [
                                        'type'  =>  'text',
                                        'text'  =>  'World!'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            $post_body = json_encode($data);
            $send_result = send_reply_message($API_URL.'/push', $POST_HEADER, $post_body);
            echo "Result: ".$send_result."\r\n";
            
                } 
            }

    }
}
echo "OK";
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
?>