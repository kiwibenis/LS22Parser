<?php
function discordMsgSend($notify_content="0", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Verwirrter Bauer", $avatar_url="https://ic-cdn.flipboard.com/gamespot.com/0c06267f5375da5e4a509ef8bacf37fa1e8176a4/_small.jpeg"){
	$message = json_encode([
		"content" => $notify_content,
		"username" => $username,
		"avatar_url" => $avatar_url,
	], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	$send = curl_init($webhook);

	curl_setopt($send, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($send, CURLOPT_POST, 1);
	curl_setopt($send, CURLOPT_POSTFIELDS, $message);
	curl_setopt($send, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($send, CURLOPT_HEADER, 0);
	curl_setopt($send, CURLOPT_RETURNTRANSFER, 1);

	$output = curl_exec($send);

	curl_close($send);
}
?>
