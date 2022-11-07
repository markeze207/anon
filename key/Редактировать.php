<?
$kbd = [
    'inline' => true,
    'buttons' => [
        [getBtn("🙋‍♂️Пол", 'secondary', 'Пол'),getBtn("👶Возраст",'secondary','Возраст')],
    ]
];
message($user_id,'⚙Настройки',$kbd);
?>