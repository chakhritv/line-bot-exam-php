<?php



require "vendor/autoload.php";

$access_token = 'pu8nokP8V1+oyKkSkUQjeo2SXvwRL0IYSnJi8BB1ZrpW2hy+d6p/RdeyNXzXvMoIiK90/ghMpwFHN3iX1q620DBGQffgg3D7KHELGUHHQHMOzQTCAaXouwCck+HvP9N/+3431c7LmbZIpMBdzBmaVwdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'a9d0f62976360fbf89490324fac2e705';

$pushID = 'Udc5308c251363df098d95f43c50d64c8';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







