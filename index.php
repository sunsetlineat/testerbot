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
$getData = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/'), TRUE);
if(!empty($getData['data'])){
    $priceList =[];
    foreach($getData['data'] as $val){
    $priceList[$val['symbol']] = 'Current Price: ' . $val['quotes']['USD']['price'] . ' USD '; 
    }
}
if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                $text = $event['message']['text'];
                if(in_array(strtoupper($text), array_keys($priceList))) {
                    $temp = $priceList[strtoupper($text)];
                    $data = [
                        'replyToken' => $reply_token,
                        'messages' => [[ 'type' => 'text', 'text' => $temp ]]
                    ];
                    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                    $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                } elseif($text=='Bitkub Menu'){
                    $data = '{"to":"'. $event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{
                    "type": "bubble",
                    "hero": {
                        "type": "image",
                        "url": "https://preview.ibb.co/hPYGQe/ce1d9357197fa496459f9f62f102ab51ecd4311c.jpg",
                        "size": "full",
                        "aspectRatio": "20:13",
                        "aspectMode": "cover"
                    },
                    "body": {
                        "type": "box",
                        "layout": "vertical",
                        "spacing": "md",
                        "contents": [
                        {
                            "type": "box",
                            "layout": "vertical",
                            "margin": "lg",
                            "spacing": "sm",
                            "contents": [
                            {
                                "type": "text",
                                "text": "FAQ Support",
                                "color": "#1DB446",
                                "weight": "bold",
                                "size": "xl"
                            },
                            {
                                "type": "text",
                                "text": "categories กรุณาเลือกหมวดหมู่คำถาม",
                                "size": "xs",
                                "color": "#aaaaaa",
                                "wrap": true
                            }
                            ]
                        },
                        {
                            "type": "separator",
                            "margin": "lg"
                        },
                        {
                            "type": "box",
                            "layout": "vertical",
                            "margin": "lg",
                            "spacing": "sm",
                            "contents": [
                            {
                                "type": "box",
                                "layout": "vertical",
                                "spacing": "sm",
                                "contents": [
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ข้อมูลทั่วไป",
                                    "displayText": "ข้อมูลทั่วไป",
                                    "data": "ข้อมูลทั่วไป"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "เริ่มต้นการใช้งาน",
                                    "displayText": "เริ่มต้นการใช้งาน",
                                    "data": "เริ่มต้นการใช้งาน"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ความปลอดภัย",
                                    "displayText": "ความปลอดภัย",
                                    "data": "ความปลอดภัย"
                                    }
                                }
                                ]
                            },
                            {
                                "type": "box",
                                "layout": "vertical",
                                "spacing": "sm",
                                "contents": [
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ความรู้เกี่ยวกับการเทรด",
                                    "displayText": "ความรู้เกี่ยวกับการเทรด",
                                    "data": "ความรู้เกี่ยวกับการเทรด"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "จัดการบัญชี",
                                    "displayText": "จัดการบัญชี",
                                    "data": "จัดการบัญชี"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ช่วยเหลือ",
                                    "displayText": "ช่วยเหลือ",
                                    "data": "ช่วยเหลือ"
                                    }
                                }
                                ]
                            }
                            ]
                        },
                        {
                            "type": "separator",
                            "margin": "lg"
                        }
                        ]
                    },
                    "footer": {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                        {
                            "type": "button",
                            "style": "link",
                            "color": "#1DB446",
                            "height": "sm",
                            "action": {
                            "type": "uri",
                            "label": "Bitkub support",
                            "uri": "https://support.bitkub.com/hc/categories/360000031152-HOW-CAN-WE-HELP-YOU-"
                            }
                        }
                        ]
                    }
                    }}]}';
                    $post_body = $data;
                    $send_result =send_reply_message($API_URL.'/push',$POST_HEADER,$post_body);
                }
                elseif($text == 'Contact us'){
                     $data = '{"to":"'. $event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"Bitkub Online Co., Ltd","weight":"bold","size":"xl"},{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"box","layout":"baseline","spacing":"sm","contents":[{"type":"text","text":"Place","color":"#aaaaaa","size":"sm","flex":1},{"type":"text","text":"15cd, 15th floor, 29/1, Piya Place Building, Pathum Wan, Bangkok","wrap":true,"color":"#666666","size":"sm","flex":5}]},{"type":"box","layout":"baseline","spacing":"sm","contents":[{"type":"text","text":"E-mail","color":"#aaaaaa","size":"sm","flex":1},{"type":"text","text":"support@bitkub.com","wrap":true,"color":"#666666","size":"sm","flex":5}]}]}]},"footer":{"type":"box","layout":"vertical","spacing":"sm","contents":[{"type":"button","style":"link","height":"sm","action":{"type":"uri","label":"CALL","uri":"tel:0203229555"}},{"type":"spacer","size":"sm"}],"flex":0}}}]}';
                     $post_body = $data;
                     $send_result =send_reply_message($API_URL.'/push',$POST_HEADER,$post_body);
                } elseif($text == 'Coin Price') {
                    $data = '{"to":"'. $event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{"type":"bubble","hero":{"type":"image","url":"https://bitkubblockchain.com/wp-content/uploads/2018/01/line-menu-02.jpg","size":"full","aspectRatio":"20:13","aspectMode":"cover"},"body":{"type":"box","layout":"vertical","spacing":"md","contents":[{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"text","text":"CLICK TO CHECK CURRENT PRICE","weight":"bold","color":"#1DB446","size":"sm"}]},{"type":"separator","margin":"lg"},{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"box","layout":"horizontal","spacing":"sm","contents":[{"type":"button","style":"primary","action":{"type":"postback","label":"BTC","displayText":"Bitcoin","data":"BTC"}},{"type":"button","style":"primary","action":{"type":"postback","label":"ETH","displayText":"ETH","data":"ETH"}},{"type":"button","style":"primary","action":{"type":"postback","label":"WAN","displayText":"WAN","data":"WAN"}}]},{"type":"box","layout":"horizontal","spacing":"sm","contents":[{"type":"button","style":"primary","action":{"type":"postback","label":"ADA","displayText":"ADA","data":"ADA"}},{"type":"button","style":"primary","action":{"type":"postback","label":"OMG","displayText":"OMG","data":"OMG"}},{"type":"button","style":"primary","action":{"type":"postback","label":"XRP","displayText":"XRP","data":"XRP"}}]}]}]},"footer":{"type":"box","layout":"vertical","contents":[{"type":"button","style":"primary","action":{"type":"postback","label":"SET NOTIFICATION TIME","displayText":"SET NOTIFICATION TIME","data":"SET NOTIFICATION TIME"}},{"type":"button","style":"secondary","margin":"sm","action":{"type":"uri","label":"CHECK OUT BITKUB MARKET","uri":"https://www.bitkub.com/market"}}]}}}]}';
                    $post_body = $data;
                    $send_result = send_reply_message($API_URL.'/push', $POST_HEADER, $post_body);
                }
            } else { 
             
            }
                } elseif( $event['type'] == ' ') {
                        $text = $event['postback']['data'];
            
                    if(in_array(strtoupper($text), array_keys($priceList))) {
                        $temp = $priceList[strtoupper($text)];
                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => $temp ]]
                            ];
                        
                    } elseif($text=='ข้อมูลทั่วไป'){
                    $data = '{"to":"'.$event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{
                    "type": "bubble",
                    "hero": {
                        "type": "image",
                        "url": "https://preview.ibb.co/hPYGQe/ce1d9357197fa496459f9f62f102ab51ecd4311c.jpg",
                        "size": "full",
                        "aspectRatio": "20:13",
                        "aspectMode": "cover"
                    },
                    "body": {
                        "type": "box",
                        "layout": "vertical",
                        "spacing": "md",
                        "contents": [
                        {
                            "type": "box",
                            "layout": "vertical",
                            "margin": "lg",
                            "spacing": "sm",
                            "contents": [
                            {
                                "type": "text",
                                "text": "General",
                                "color": "#1DB446",
                                "weight": "bold",
                                "size": "xl"
                            },
                            {
                                "type": "text",
                                "text": "articles กรุณาเลือกบทความ",
                                "size": "xs",
                                "color": "#aaaaaa",
                                "wrap": true
                            }
                            ]
                        },
                        {
                            "type": "separator",
                            "margin": "lg"
                        },
                        {
                            "type": "box",
                            "layout": "vertical",
                            "margin": "lg",
                            "spacing": "sm",
                            "contents": [
                            {
                                "type": "box",
                                "layout": "vertical",
                                "spacing": "sm",
                                "contents": [
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "Bitkub คือใคร ?",
                                    "displayText": "Who is Bitkub",
                                    "data": "Who is Bitkub"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "Bitkub ให้บริการอะไรบ้าง ?",
                                    "displayText": "Sevices of Bitkub",
                                    "data": "Sevices of Bitkub"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ช่องทางการช่วยเหลือ",
                                    "displayText": "Help channel",
                                    "data": "Help channel"
                                    }
                                }
                                ]
                            },
                            {
                                "type": "box",
                                "layout": "vertical",
                                "spacing": "sm",
                                "contents": [
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "เวลาทำการของเรา",
                                    "displayText": "Service time",
                                    "data": "Service time"
                                    }
                                },
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "action": {
                                    "type": "postback",
                                    "label": "ใครสามารถใช้บริการ bitkub ?",
                                    "displayText": "Who can use Bitkub services",
                                    "data": "Who can use Bitkub services"
                                    }
                                }
                                ]
                            }
                            ]
                        },
                        {
                            "type": "separator",
                            "margin": "lg"
                        }
                        ]
                    },
                    "footer": {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                        {
                            "type": "button",
                            "style": "link",
                            "color": "#1DB446",
                            "height": "sm",
                            "action": {
                            "type": "uri",
                            "label": "Bitkub support",
                            "uri": "https://support.bitkub.com/hc/categories/360000031152-HOW-CAN-WE-HELP-YOU-"
                            }
                        }
                        ]
                    }
                    }}]}';
                    $post_body = $data;
                    $send_result = send_reply_message($API_URL.'/push',$POST_HEADER,$post_body);
                    
                }

                        elseif($text=='Who is Bitkub'){
                           $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => '' ]]
                            ];   
                        }elseif($text==''){
                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => 'Set notification time : every 1 hour' ]]
                            ];
                        }elseif($text=='EVERY DAY'){

                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => 'Set notification time : every day' ]]
                            ];
                        } else {
                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => 'Not Found' ]]
                            ];
                }
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
            
            } else {
            
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
