<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '47bc90719fa07a6a119bea4d462a29f6';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

//database
$host = 'ec2-54-235-75-214.compute-1.amazonaws.com'; 
$dbname = 'd3h5p6c9frv0nc'; 
$user = 'wesfrycfmkpxwx'; 
$pass = 'ff7f9081467a3c7deceef1ff58b70b6d24317fee491f077eec63f2a49dff0eaa'; 
$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

$params = array (
'userID' => $event['source']['userID'],
'notiTime' =>time('hh:mm:ss')
);

$coinNotification = $connection->prepare('INSERT INTO settingTime(userID,notiTime) VALUES (:userID, :notiTime)');
$coinNotification->execute($params);

// coin API
$getData = json_decode(file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10'), TRUE);
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
                // Type Text
                $text = $event['message']['text'];
                if(in_array(strtoupper($text), array_keys($priceList))) {
                    $temp = $priceList[strtoupper($text)];
                    $data = [
                        'replyToken' => $reply_token,
                        // 'messages' => [['type' => 'text', 'text' => $reply_message]]
                        'messages' => [[ 'type' => 'text', 'text' => $temp ]]
                    ];
                    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                    $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

                } elseif($text == 'Contact us'){
                     $data = '{"to":"'. $event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{"type":"bubble","body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"Bitkub Online Co., Ltd","weight":"bold","size":"xl"},{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"box","layout":"baseline","spacing":"sm","contents":[{"type":"text","text":"Place","color":"#aaaaaa","size":"sm","flex":1},{"type":"text","text":"15cd, 15th floor, 29/1, Piya Place Building, Pathum Wan, Bangkok","wrap":true,"color":"#666666","size":"sm","flex":5}]},{"type":"box","layout":"baseline","spacing":"sm","contents":[{"type":"text","text":"E-mail","color":"#aaaaaa","size":"sm","flex":1},{"type":"text","text":"support@bitkub.com","wrap":true,"color":"#666666","size":"sm","flex":5}]}]}]},"footer":{"type":"box","layout":"vertical","spacing":"sm","contents":[{"type":"button","style":"link","height":"sm","action":{"type":"uri","label":"CALL","uri":"tel:0203229555"}},{"type":"spacer","size":"sm"}],"flex":0}}}]}';
                     $post_body = $data;
                     $send_result =send_reply_message($API_URL.'/push',$POST_HEADER,$post_body);


                } elseif($text == 'Coin Price') {
                    $data = '{"to":"'. $event['source']['userId'] .'","messages":[{"type":"flex","altText":"This is a Flex Message","contents":{"type":"bubble","hero":{"type":"image","url":"https://bitkubblockchain.com/wp-content/uploads/2018/01/line-menu-test.png","size":"full","aspectRatio":"20:13","aspectMode":"cover"},"body":{"type":"box","layout":"vertical","spacing":"md","contents":[{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"text","text":"CLICK TO CHECK CURRENT PRICE","weight":"bold","color":"#1DB446","size":"sm"}]},{"type":"separator","margin":"lg"},{"type":"box","layout":"vertical","margin":"lg","spacing":"sm","contents":[{"type":"box","layout":"horizontal","spacing":"sm","contents":[{"type":"button","style":"primary","action":{"type":"postback","label":"BTC","displayText":"Bitcoin","data":"BTC"}},{"type":"button","style":"primary","action":{"type":"postback","label":"ETH","displayText":"ETH","data":"ETH"}},{"type":"button","style":"primary","action":{"type":"postback","label":"WAN","displayText":"WAN","data":"WAN"}}]},{"type":"box","layout":"horizontal","spacing":"sm","contents":[{"type":"button","style":"primary","action":{"type":"postback","label":"ADA","displayText":"ADA","data":"ADA"}},{"type":"button","style":"primary","action":{"type":"postback","label":"OMG","displayText":"OMG","data":"OMG"}},{"type":"button","style":"primary","action":{"type":"postback","label":"XRP","displayText":"XRP","data":"XRP"}}]}]}]},"footer":{"type":"box","layout":"vertical","contents":[{"type":"button","margin":"sm","action":{"type":"uri","label":"CHECK OUT BITKUB MARKET","uri":"https://www.bitkub.com/market"},"style":"secondary"}]}}}]}';
                    $post_body = $data;
                    $send_result = send_reply_message($API_URL.'/push', $POST_HEADER, $post_body);

                }
            } else { 
              
            }
                } elseif( $event['type'] == 'postback') {
                        $text = $event['postback']['data'];
            
                    if(in_array(strtoupper($text), array_keys($priceList))) {
                        $temp = $priceList[strtoupper($text)];
                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => $temp ]]
                            ];
                        }else {
                            $data = [
                                'replyToken' => $reply_token,
                                'messages' => [[ 'type' => 'text', 'text' => 'Not Found' ]]
                            ] ;
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