<?php



require "vendor/autoload.php";

$access_token = 'pu8nokP8V1+oyKkSkUQjeo2SXvwRL0IYSnJi8BB1ZrpW2hy+d6p/RdeyNXzXvMoIiK90/ghMpwFHN3iX1q620DBGQffgg3D7KHELGUHHQHMOzQTCAaXouwCck+HvP9N/+3431c7LmbZIpMBdzBmaVwdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'a9d0f62976360fbf89490324fac2e705';

$pushID = 'U604b109c9a00e27010393d8c2633816b';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world san');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







