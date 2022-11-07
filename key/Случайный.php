<?
if($user['ban_time'] > 0) {
    $min = $user['ban_time'] - time();
    message($user_id,'Ты находишься в блокировке, до конца блокировки '.secToStr($min));
} else {
    $sql = mysqli_query($link,"SELECT * FROM `user` WHERE `poisk` > '0' and `poisk` < '4'");
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            if($row['poisk'] == 1) {
                $kbd = [
                    'one_time' => false,
                    'buttons' => [
                        [getBtn("Завершить диалог", 'negative', 'Отключиться')],
                    ]
                ];
                $link->query("UPDATE `user` SET `chat_user`='".$user_id."',`poisk`='0' WHERE user_id = '".$row['user_id']."'");
                $link->query("UPDATE `user` SET `chat_user`='".$row['user_id']."',`poisk`='0' WHERE user_id = '".$user_id."'");
                message($user_id,'Ты нашел себе собеседника',$kbd);
                message($row['user_id'],'Ты нашел себе собеседника',$kbd);
                die('OK');
            } elseif($row['poisk'] == 2 and $user['sex'] == 'Мужской') {
                $kbd = [
                    'one_time' => false,
                    'buttons' => [
                        [getBtn("Завершить диалог", 'negative', 'Отключиться')],
                    ]
                ];
                $link->query("UPDATE `user` SET `chat_user`='".$user_id."',`poisk`='0' WHERE user_id = '".$row['user_id']."'");
                $link->query("UPDATE `user` SET `chat_user`='".$row['user_id']."',`poisk`='0' WHERE user_id = '".$user_id."'");
                message($user_id,'Ты нашел себе собеседника',$kbd);
                message($row['user_id'],'Ты нашел себе собеседника',$kbd);
                die('OK');
    
            } elseif($row['poisk'] == 3 and $user['sex'] == 'Женский') {
                $kbd = [
                    'one_time' => false,
                    'buttons' => [
                        [getBtn("Завершить диалог", 'negative', 'Отключиться')],
                    ]
                ];
                $link->query("UPDATE `user` SET `chat_user`='".$user_id."',`poisk`='0' WHERE user_id = '".$row['user_id']."'");
                $link->query("UPDATE `user` SET `chat_user`='".$row['user_id']."',`poisk`='0' WHERE user_id = '".$user_id."'");
                message($user_id,'Ты нашел себе собеседника',$kbd);
                message($row['user_id'],'Ты нашел себе собеседника',$kbd);
                die('OK');
    
            } else {
                $link->query("UPDATE `user` SET `poisk`='1' WHERE user_id = '".$user_id."'");
                $kbd = [
                    'one_time' => false,
                    'buttons' => [
                        [getBtn("Отменить поиск", 'primary', 'Отменить')],
                    ]
                ];
                message($user_id,'🔎 Ищем собеседника..',$kbd);
                die('OK');
            }
        }
    }
    else {
        $link->query("UPDATE `user` SET `poisk`='1' WHERE user_id = '".$user_id."'");
        $kbd = [
            'one_time' => false,
            'buttons' => [
                [getBtn("Отменить поиск", 'primary', 'Отменить')],
            ]
        ];
        message($user_id,'🔎 Ищем собеседника..',$kbd);
    }
}
?>