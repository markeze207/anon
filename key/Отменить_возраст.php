<?
$link->query("UPDATE `user` SET `peremen` = '0' WHERE user_id = '".$user_id."'");
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("🎲Случайный собеседник", 'secondary', 'Случайный')],
        [getBtn("❤️Поиск по полу", 'secondary', 'По_полу'), getBtn("😈 Пошлый чат",'secondary','Пошлый_чат')],
        [getBtn("🛠 Профиль", 'secondary', 'Профиль')],
    ]
];
message($user_id,'⚡️Выбери действие:',$kbd);

?>