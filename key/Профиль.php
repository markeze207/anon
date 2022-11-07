<?
if($user['vip'] > 0) {
    $kbd = [
        'inline' => true,
        'buttons' =>[
            [getBtn("⚙Редактировать", 'secondary', 'Редактировать')],
        ]
    ];
    $min = secToStr($user['vip'] - time());
} else {
    $kbd = [
        'inline' => true,
        'buttons' =>[
            [getBtn("⚙Редактировать", 'secondary', 'Редактировать')],
            [getBtn("🏆Попробовать VIP", 'secondary', 'Купить_вип')],
        ]
    ];
    $min = "Отсутствует";
}
message($user_id,'🎭Мой профиль<br><br>Пол: '.$user['sex'].'<br>Возраст: '.$user['old'].'<br><br>VIP: '.$min.'<br><br>Всего диалогов: '.$user['dialog'].'<br>Всего сообщений: '.$user['message'],$kbd);
?>