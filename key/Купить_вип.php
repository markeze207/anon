<?
$kbd = [
    'inline' => true,
    'buttons' => [
        [getBtn("🎗24 часа за 79₽", 'primary', '24ч')],
        [getBtn("🥉7 дней за 149", 'primary', '7д')],
        [getBtn("🥈30 дней за 179₽", 'primary', '30д')],
        [getBtn("🥇Навсегда за 499₽", 'primary', 'Навсегда')],
    ]
];
$time = time() + 60*10;
$link->query("UPDATE `user` SET `time`='".$time."' WHERE user_id = '".$user_id."'");
message($user_id,'🏆 Получите VIP:<br><br>🔞 Общайтесь в пошлом чате<br>🔍 Ищите по полу (м/ж)<br>🎥 Обмен фото и видео', $kbd);

?>