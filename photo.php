<?
$group_id = $data->group_id;
$count = count($data->object->message->attachments);//Получаем количество фотографий. 
if(!empty($data->object->message->is_cropped)) {
    message($user_id,'Отправлять больше 1 фотографий нельзя');
    die('OK');
}
if($count > 1) {
    message($user_id,'Отправлять больше 1 фотографий нельзя');
    die('OK');
}
$type = $data->object->message->attachments[0]->photo->id;
$sizes = $data->object->message->attachments[0]->photo->sizes;
$count_size = count($sizes);
$h = '';
$w = '';
for($is = 0; $is != $count_size; $is ++){//ТВОЙ КОД 
    if($data->object->message->attachments[0]->photo->sizes[$is]->height >= $h){
        $h = $data->object->message->attachments[0]->photo->sizes[$is]->height;
        $m = $is;
    }
    if($data->object->message->attachments[0]->photo->sizes[$is]->width >= $w){
        $w = $data->object->message->attachments[0]->photo->sizes[$is]->width;
        $m = $is;
    }
}//
//ДЕЛИТ ССЫЛКУ ЧТОБЫ ПОЛУЧИТЬ ТИП ФАЙЛА 
$url = $data->object->message->attachments[0]->photo->sizes[$m]->url;
$inf = explode('com/', $url);
$inf = explode('.', $inf[1]);
if(strpos($inf[1], '?') !== false){
    $inf = explode('?', $inf[1]);
    $tt = $inf[0];  
}
else{
    $tt = $inf[1];
}
//
//Копирует
if (!copy($url,'/home/vitalya/sites/lillego.eu/anon/photo/'.$type.'.'.$tt)) {
    message($user_id,'К сожалению отправить фото не удалось');
    die('ok');
}
//
//В массивы 
$fills_mass[0] = $type.'.'.$tt; //$tt получает тип файла. PNG или же JPG - для дольнешего сохранения на сервер.
//
$fills = 'file1';
$mass_file[$fills] = new CURLFile(__DIR__."/photo/".$type.'.'.$tt);
$request_params = array( 
    'group_id' => $group_id,
    'access_token' => $token,
    'v' => '5.81'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/photos.getMessagesUploadServer?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result =  json_decode($result, 1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $result['response']['upload_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $mass_file);
$datas = json_decode(curl_exec($ch), true);
curl_close($ch);
$request_params = array( 
    'photo' => $datas['photo'],
    'server' => $datas['server'],
    'hash' => $datas['hash'],
    'access_token' => $token, 
    'v' => '5.81'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/photos.saveMessagesPhoto?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$save =  json_decode($result, 1);
if($save['response'][0]['owner_id'] != 0){$text = 'photo'.$save['response'][0]['owner_id'].'_'.$save['response'][0]['id'].'_'.$save['response'][0]['access_key'];}
if(!empty($message)) {
    $mess = $message;
} else {
    $mess = '';
}
$request_params = array( 
    'peer_id' => $user['chat_user'],
    'message' => $mess, 
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
$count = count($fills_mass);
//Теперь будет удалться.*/
unlink(__DIR__."/photo/".$type.'.'.$tt);
die('OK');
