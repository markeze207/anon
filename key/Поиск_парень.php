<?
if($user['sex'] == 'Мужской') {
    $poisk = '3';
} else {
    $poisk = '2';
}
$sql = mysqli_query($link,"SELECT * FROM `user` WHERE `poisk` > 0 and `poisk` != '".$poisk."' and `poisk` != '4' and `sex` = 'Мужской' LIMIT 1");
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
    $link->query("UPDATE `user` SET `poisk`='2' WHERE user_id = '".$user_id."'");
    $kbd = [
        'one_time' => false,
        'buttons' => [
            [getBtn("Отменить поиск", 'primary', 'Отменить')],
        ]
    ];
    message($user_id,'🔎 Ищем собеседника..',$kbd);
}
?>