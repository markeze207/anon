<?
//SOSI
$data = json_decode(file_get_contents('php://input')); 
$grup_id = $data->group_id; 
$token = ''; // VK TOKEN
$link = new mysqli('localhost', 'root', 'PASSWORD_BD', 'anon_chat');
require_once('publick.php'); // url file "publick.php"
if ($data->type == 'confirmation') {
    $scret = $data->secret;$d_id = $data->secret;die($scret);
}
elseif($data->type == 'message_new'){
    $user_id = $data->object->message->from_id; 
    $message = $data->object->message->text;
    require_once('load_user.php');
    if(!empty($data->object->message->payload)) {
        $payload = $data->object->message->payload;
        $payload = json_decode($payload,true);
        $name_file = '/key/'.$payload.'.php'; // url file "/key/"
        $name_file_two = mb_strtolower($name_file);
        if(file_exists($name_file)) {
            require_once($name_file);
        }
        elseif(file_exists($name_file_two)) {
            require_once($name_file_two);
        }
    }
    else{
        if($user['peremen'] != 0) {
            require_once('peremen.php'); 
        }
        if($user['chat_user'] != 0){
            if(!empty($data->object->message->attachments)) {
                if($data->object->message->attachments[0]->type == 'sticker') {
                    require_once('sticker.php');
                }
                elseif($data->object->message->attachments[0]->type == 'audio_message') {
                    require_once('voice.php'); 
    
                }
                elseif($data->object->message->attachments[0]->type == 'photo') {
                    require_once('photo.php');
                    die('OK');
                }
                elseif($data->object->message->attachments[0]->type == 'doc') {
                    message($user_id,'К сожалению, у нас отправка документов запрещена');
                    die('OK');
                }
                elseif($data->object->message->attachments[0]->type == 'link') {
                    if($user['vip'] == 0) {
                        require_once('generate.php');
                        $link->query("UPDATE `user` SET `captcha`='".$code."',`peremen`='2' WHERE user_id = '".$user_id."'");
                        message($user_id,'⚠Замечена подозрительная активность<br><br>VIP-пользователи никогда не получают это сообщение.<br><br>✏Пожалуйста введите капчу, чтобы продолжить:','',$text);
                        die('OK');
                    }
                    else {
                        $link->query("UPDATE `user` SET `message`=`message`+1 WHERE user_id = '".$user_id."'");
                        message($user['chat_user'],$data->object->message->attachments[0]->link->url);
                        die('ok');
                    }
                }
                elseif($data->object->message->attachments[0]->type == 'video') {
                    if($user['vip'] == 0) {
                        message($user_id,'Отправка видео доступно только с VIP');
                        die('OK');
                    } else {
                        require_once('video.php');
                    }
                    
    
                }
            }
            else{
                if($user['vip'] == 0) {
                    $sql = mysqli_query($link,"SELECT `name` FROM `ban` WHERE 1");
                    while ($row = mysqli_fetch_assoc($sql)) {
                        if(preg_match('/('.$row['name'].')/i', $message) == 1) { // Для проверки строк в сообщении
                            require_once('generate.php');
                            $link->query("UPDATE `user` SET `captcha`='".$code."',`peremen`='2' WHERE user_id = '".$user_id."'");
                            message($user_id,'⚠Замечена подозрительная активность<br><br>VIP-пользователи никогда не получают это сообщение.<br><br>✏Пожалуйста введите капчу, чтобы продолжить:','',$text);
                            die('OK');
                        }
                    }
                }
                $link->query("UPDATE `user` SET `message`=`message`+1 WHERE user_id = '".$user_id."'");
                message($user['chat_user'],$message);
                die('ok');
            }
        }
    }
}
die('ok');