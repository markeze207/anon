<?
if($user['vip'] == 0) {
    message($user_id,'Данная функция доступа только для vip-пользователей');
} else {
    if($user['ban_time'] == 0) {
        $sql = mysqli_query($link,"SELECT * FROM `user` WHERE `poisk` = '4' LIMIT 1");
        $b1 = mysqli_fetch_array($sql);
        if ($b1[0] != 0) {
            $kbd = [
                'one_time' => false,
                'buttons' => [
                    [getBtn("Завершить диалог", 'negative', 'Отключиться')],
                ]
            ];
            $link->query("UPDATE `user` SET `chat_user`='".$user_id."',`poisk`='0' WHERE user_id = '".$b1['user_id']."'");
            $link->query("UPDATE `user` SET `chat_user`='".$b1['user_id']."',`poisk`='0' WHERE user_id = '".$user_id."'");
            message($user_id,'Ты нашел себе собеседника',$kbd);
            message($b1['user_id'],'Ты нашел себе собеседника',$kbd);
            die('OK');
    
        } else {
            $link->query("UPDATE `user` SET `poisk`='4' WHERE user_id = '".$user_id."'");
            $kbd = [
                'one_time' => false,
                'buttons' => [
                    [getBtn("Отменить поиск", 'primary', 'Отменить')],
                ]
            ];
            message($user_id,'🔎 Ищем собеседника..',$kbd);
            die('OK');
    
        }
    } else {
        $min = $user['ban_time'] - time();
        message($user_id,'Ты находишься в блокировке, до конца блокировки '.secToStr($min));
    }
}
?>