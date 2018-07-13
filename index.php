<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '47bc90719fa07a6a119bea4d462a29f6';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if (!is_null($request_array['events'])) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                
                $text = $event['message']['text'];
                if( $text == 'สวัสดี') {
                    $reply_message = 'สวัสดีนายท่าน ';
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
                } else{
                    $reply_message = 'สวัสดีนายท่าน '. $text;
                }
            } else { 
                $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
            }
        } else {
            $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
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