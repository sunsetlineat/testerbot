<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '47bc90719fa07a6a119bea4d462a29f6';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

// coin API
$getData = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10'), TRUE);
if(!empty($getData['data'])){
    $priceList =[];
    $priceListName =[];
    foreach($getData['data'] as $val){
    $priceList[$val['symbol']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    $priceListName[$val['name']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    }
}

// answer
if (!is_null($request_array['events'])) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                
                $text = $event['message']['text'];

                if(in_array(strtoupper($event['message']['text']),array_keys($priceList))){
                    $reply_message = $event['message']['text'].' -> '.$priceList[strtoupper($event['message']['text'])];

                    $data = [
                        'to' => $event['source']['userId'],
                        'message' => [['type' => 'text', 'text' => json_encode($priceList)])]] 
                            ];
                         $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                         $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                }

                if( $text == 'Coin Price') {


                                $data = [
                                'to' => $event['source']['userId'],
                                'messages' => [
                                [
                                'type'=> 'bubble',
                                'header'=> [
                                'type'=> 'box',
                                'layout'=> 'vertical',
                                'contents'=> [
      [
        'type'=> 'text',
        'text'=> 'Coin Price',
        'size'=> 'xl',
        'weight'=> 'bold'
      ]
                                    ]
                                ],
                                'hero'=> [
                                'type'=> 'image',
                                'url'=> 'https://bitkubblockchain.com/wp-content/uploads/2018/01/line-menu-test.png',
                                'size'=> 'full',
                                'aspectRatio'=> '20=>13',
                                'aspectMode'=> 'cover'
                                ],
                                'body'=> [
                                'type'=> 'box',
                                'layout'=> 'vertical',
                                'spacing'=> 'md',
                                'contents'=> [
      [
        'type'=> 'separator',
        'margin'=> 'lg'
      ],
      [
        'type'=> 'box',
        'layout'=> 'vertical',
        'margin'=> 'lg',
        'spacing'=> 'sm',
        'contents'=> [
          [
            'type'=> 'box',
            'layout'=> 'horizontal',
            'spacing'=> 'sm',
            'contents'=> [
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'BITCOIN',
                  'displayText'=> 'Bitcoin',
                  'data'=> 'BTC'
                ]
              ],
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'ETHEREUM',
                  'displayText'=> 'ETHEREUM',
                  'data'=> 'ETH'
                ]
              ]
            ]
          ],
          [
            'type'=> 'box',
            'layout'=> 'horizontal',
            'spacing'=> 'sm',
            'contents'=> [
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'WANCOIN',
                  'displayText'=> 'WANCOIN',
                  'data'=> 'WANCOIN'
                ]
              ],
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'CARDANO',
                  'displayText'=> 'CARDANO',
                  'data'=> 'ADA'
                ]
              ]
            ]
          ],
          [
            'type'=> 'box',
            'layout'=> 'horizontal',
            'spacing'=> 'sm',
            'contents'=> [
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'OMISEGO',
                  'displayText'=> 'OMISEGO',
                  'data'=> 'OMG'
                ]
              ],
              [
                'type'=> 'button',
                'style'=> 'primary',
                'action'=> [
                  'type'=> 'postback',
                  'label'=> 'RIPPLE',
                  'displayText'=> 'RIPPLE',
                  'data'=> 'XRP'
                ]
              ]
            ]
          ]
        ]
      ]
                                        ]
                                ],
                                'footer'=> [
                                'type'=> 'box',
                                'layout'=> 'vertical',
                                'contents'=> [
      [
        'type'=> 'button',
        'margin'=> 'sm',
        'action'=> [
          'type'=> 'uri',
          'label'=> 'CHECK OUT BITKUB MARKET',
          'uri'=> 'https=>//www.bitkub.com/market'
        ],
        'style'=> 'secondary'
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