<?
if(!empty($user['captcha'])) {
    $time = time() + (60 * 60 * 24);
    $link->query("UPDATE `user` SET `ban_time` = '".$time."',`peremen`='0', `captcha`='0', `dialog`=`dialog`+'1', `chat_user`='0',`history`='".$user['chat_user']."' WHERE user_id = '".$user_id."'");
    $captcha = '<br>Ты вышел во время капчи, поэтому получаешь бан на 24ч.';
} else {
    $link->query("UPDATE `user` SET `captcha`='0', `dialog`=`dialog`+'1', `chat_user`='0',`history`='".$user['chat_user']."' WHERE user_id = '".$user_id."'");
    $captcha = '';
}
$link->query("UPDATE `user` SET `dialog`=`dialog`+'1', `chat_user`='0',`history`='".$user_id."' WHERE user_id = '".$user['chat_user']."'");
$kbds = [
    'inline' => true,
    'one_time' => false,
    'buttons' => [
        [getBtn("Пожаловаться", 'negative', 'Репорт')],
    ]
];
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("🎲Случайный собеседник", 'secondary', 'Случайный')],
        [getBtn("❤️Поиск по полу", 'secondary', 'По_полу'), getBtn("😈 Пошлый чат",'secondary','Пошлый_чат')],
        [getBtn("🛠 Профиль", 'secondary', 'Профиль')],
    ]
];
$ch = curl_init();
message($user_id,'Ты отлючился от собеседника'.$captcha,$kbd);
message($user['chat_user'],'Твой собеседник покинул чат',$kbd);
message($user_id,'Ты можешь пожаловаться на собеседника. Если он получит достаточное кол-во жалоб - он будет заблокирован.',$kbds);
message($user['chat_user'],'Ты можешь пожаловаться на собеседника. Если он получит достаточное кол-во жалоб - он будет заблокирован.',$kbds);
