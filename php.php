<?php 
$BOT_TOKEN = "770506138:AAGSSp_BOuvmlzWY1cBdrsApMv4zL5dbYa8";
$API_URL = "https://api.telegram.org/bot".$BOT_TOKEN;
 
// read incoming info and grab the chatID
$content = file_get_contents($API_URL."/getupdates");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$got_message = $update["message"]["text"];

// compose reply
$reply =  $got_message;
  
// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
file_get_contents($sendto);
?>