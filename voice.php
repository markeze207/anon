<?
$type = $data->object->message->attachments[0]->audio_message->id;
$url = $data->object->message->attachments[0]->audio_message->link_mp3;
$acess_token = $data->object->message->attachments[0]->audio_message->access_key;
$voice = '/home/vitalya/sites/lillego.eu/anon/mp3/'.$type.'.mp3';
if (!copy($url,$voice)) {
    message($user_id,'Не удалось отправить голосовое сообщение');
    die('ok');
}
$ch = curl_init();
$request_params = array( 
    'type' => 'audio_message',
    'access_token' => $token,
    'peer_id' => $user['chat_user'],
    'v' => '5.131'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/docs.getMessagesUploadServer?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result =  json_decode($result, 1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $result['response']['upload_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($voice)]);
$datas = json_decode(curl_exec($ch), true);
curl_close($ch);
$request_params = array( 
    'file' => $datas['file'],
    'access_token' => $token,
    'title' => 'test',
    'tags' => 'tags_test',
    'v' => '5.131'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/docs.save?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result =  json_decode($result, 1);
$owner = $result['response']['audio_message']['owner_id'];
$id = $result['response']['audio_message']['id'];
$request_params = array( 
    'peer_id' => $user['chat_user'],
    'attachment' => 'doc'.$owner.'_'.$id,
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
unlink($voice);
die('OK');