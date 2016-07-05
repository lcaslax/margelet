<?php
// insert here your Bot API token
define("BOT_TOKEN", "...");
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}
$message = isset($update['message']) ? $update['message'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$text = isset($message['text']) ? $message['text'] : "";
$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
// change image name and path
$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("image.png")), 'caption' => $text);
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
curl_setopt($ch, CURLOPT_URL, $botUrl); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
// read curl response
$output = curl_exec($ch);