<?
if(!empty($data->object->message->is_cropped)) {
    message($user_id,'Отправлять больше 1 видео нельзя');
    die('OK');
} if(count($data->object->message->attachments) > 1) {
        message($user_id,'Отправлять больше 1 видео нельзя');
    die('OK');
}
if($data->object->message->attachments[0]->video->owner_id != 0){
    $text = 'video'.$data->object->message->attachments[0]->video->owner_id.'_'.$data->object->message->attachments[0]->video->id.'&'.$data->object->message->attachments[0]->video->access_key;
}
$ch = curl_init();
$request_params = array( 
    'peer_id' => $user['chat_user'],
    'attachment' => $text,
    'access_token' => $token, 
    'v' => '5.81'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result =  json_decode($result, 1);
die('OK');