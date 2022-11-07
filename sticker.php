<?
$stiker_id = $data->object->message->attachments[0]->sticker->sticker_id;
$request_params = array( 
    'peer_id' => $user['chat_user'], 
    'sticker_id' => $stiker_id,
    'access_token' => $token, 
    'v' => '5.81',
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result, 1); 
if(!empty($result['error']['error_code'])) {
    message($user_id,'К сожалению, данный стикер не доступен для отправки.');
}
mysqli_close($link);die('ok');