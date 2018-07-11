<?php

$hour = (int)date('H');

if ($hour >= 7 && $hour <= 17) {

	// Get random image from Giphy
	$apikey = 'YOUR_API_KEY';
	$offset = rand(0, 2000);
	$url = "http://api.giphy.com/v1/gifs/search?q=fitness&api_key=".$apikey."&limit=1&offset=".$offset;
	$img = json_decode(file_get_contents($url))->data[0];
	$img_url = $img->images->downsized->url;

	// Send message to discord
	$url = 'https://discordapp.com/api/webhooks/466154360628314112/YOUR_DISCORD_WEBHOOK';
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
	    "content" => "==== Standup to do Exercise. ====", 
	    "username" => "Exercise Reminder", 
	    "avatar_url" => "https://i.pinimg.com/originals/31/3f/50/313f50fc570588f2caccf30992a4d4b7.jpg",
	    "embeds" => array(array("image" => array(
	        "url" => $img_url
	    )))
	)));

	curl_exec($curl);
	
}
?>

