<?
if($user['vip'] == 0) {
    message($user_id,'Данная функция доступа только для vip-пользователей');
    die('OK');
} else {
    if($user['ban_time'] == 0) {
        $kbd = [
            'one_time' => false,
            'buttons' => [
                [getBtn("🙋‍♂️Парень", 'primary', 'Поиск_парень'),getBtn("🙋‍♀️Девушка", 'positive', 'Поиск_девушка')],
            ]
        ];
        message($user_id,'Кого ты хочешь искать?',$kbd);
    } else {
        $min = $user['ban_time'] - time();
        message($user_id,'Ты находишься в блокировке, до конца блокировки '.secToStr($min));
    }

}
?>