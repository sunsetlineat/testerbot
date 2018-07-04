<?php 

require_once('./vendor/autoload.php'); // Namespace 
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 

$channel_token = 'elrTlEnZYv9BqQTLFDG+PsaT3VdBjCzs9/nhqkNNGFaHQDveBfVE2xL0ddW+PGl1sK/tCikVIoIq8ZcPaPIkgNIWdRO/QeEEENO0+UzmaKZrcZbCc9DDQ8cyoNuVN3Z0R4ewRaMjlDmMD3rePRDxnQdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '47bc90719fa07a6a119bea4d462a29f6'; 

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
                $respMessage = 'Hello, your message is '. $event['message']['text'];
                $respMessage = getdata();
                break;
                default:
                //Reply message
                $respMessage='What a nice day!';
                break;
            }
                                         }
        else if($event['type']=='follow'){     
            // Greeting 
            $respMessage = 'Thanks you. I try to be your best friend.'; 
            
       
        }
        $httpClient = new CurlHTTPClient($channel_token); 
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    }
    
} 
echo "OK";

function getdata(intervalTime = 10){
            setInterval(function(){ 
                fetch('http://192.168.10.241:5000/api/fromDB')
                .then(response => response.json())
                .then(data => {
                console.log(data) // Prints result from `response.json()` in getRequest
                var namesym = document.getElementById($event['message']['text']).value;
                //var check_data = 0;
                // alert(namesym);
                for(var i=0;i<100;i++){
                    if(namesym == data.DB[i].name || namesym == data.DB[i].symbol){
                        alert(data.DB[i].quotes.USD.price+" USD, \n"+data.DB[i].quotes.THB.price+" THB");
                    }
                }
                })
                .catch(error => console.error(error))
            }, intervalTime);
        }