<?php

$access_token="EAAZAT6dcgYDQBAORIr56ZBT2YwxbZBLhDGuh025lZAtZCQRHCj4cr7XCpZCd2CGEwiFUwnWYP7DfrEbfTmy7qHQdwuWgenZAHBkeZBsWDHqzxKNcSF1aQ295h88HlHZCYP2OtcZCZCbJTHCLsRFFu8pbCWidZCLjha9TnjkZAF19bDayU2AZDZD";
$verify_token = "my_example_veryfy_token";


function myLog($str) {
    file_put_contents("php://stdout", "$str\n");
}

$hub_verify_token = null;
$wordList_greeting = array("привет");
$wordList_greeting2 = array("Егор выиграл машину?");
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

function file_get_contents_utf8($fn) {
    $content = file_get_contents($fn);
     return mb_convert_encoding($content, 'UTF-8',
         mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}


$input = json_decode(  file_get_contents_utf8('php://input') , true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text']; 
myLog($message);
if ($message) {

    $message_Response = $message;
	if (in_array($message, $wordList_greeting)) {
        $message_Response = 'Приветик! Я бот Вася!';
    }
    else if(in_array($message, $wordList_greeting2))
    {
        $message_Response = 'Да, правда! Егор выйграл BMW 3 сериию Завидуйте людишки!!';
    }
    else 
    {
        $message_Response = 'моя твоя не понимать';
    }
}
else
{
	$message_Response = "Привет! Я бот Вася";
}
//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//JSON DATA
 
$jsonData = array(
    "recipient"=>array(
        "id" => $sender
    ),
    "message"=>array(
        "text" =>  $message_Response
    ) 
);

myLog($message_Response);
//$jsonData = '{ "recipient":{ "id":"'.$sender.'" }, "message":{ "text":"'.  mb_substr($message_Response, 0, 7, "UTF-8") .'" } }';
//Encode the array into JSON.
$jsonDataEncoded =  json_encode( $jsonData , JSON_UNESCAPED_UNICODE);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($message)){
    $result = curl_exec($ch);
}
curl_close($ch);
?>