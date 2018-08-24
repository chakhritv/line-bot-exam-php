<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'pu8nokP8V1+oyKkSkUQjeo2SXvwRL0IYSnJi8BB1ZrpW2hy+d6p/RdeyNXzXvMoIiK90/ghMpwFHN3iX1q620DBGQffgg3D7KHELGUHHQHMOzQTCAaXouwCck+HvP9N/+3431c7LmbZIpMBdzBmaVwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['source']['userId'];
			$text2 = $event['message']['text'];
			$txt = 'userId:'.$text.'   message:'.$text2;
			if (strncmp(strtolower($text2), 'reg:', strlen('reg:')) === 0){
				$txt = 'Register success - userId:'.$text.'   outlet:'.substr($text2, strlen('reg:'));
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $txt
				];
			}elseif (strtolower($text2) === 'vrp'){
				$txt = 'your VRP score is 1999.99 points';
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $txt
				];
			}elseif (strtolower($text2) === 'quick reply'){
				$txt = 'quick reply';
				// Build message to reply back
				$quickReply = {
					'items': []
				}
				$messages = [
					'type' => 'text',
					'text' => $txt
				];
			}else{
				$txt = 'echo.. : '.$text2;
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $txt
				];
			}
			// Get replyToken
			$replyToken = $event['replyToken'];


		}else{
			$event_type =  $event['type'];
			$source_userid = $event['source']['userId'];
			
			$txt = 'event-type:'.$event_type.'    event-source-userId'.$source_userid;
				
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $txt
			];
		}
		
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		
	}
}
echo "OK1";
