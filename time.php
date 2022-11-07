<?
// Подключить на этот файл крон/демона
$link = new mysqli('localhost', 'root', 'PASSWORD_BD', 'anon_chat');
$token = ''; // VK TOKEN
require_once('publick.php');
$query = mysqli_query($link,"SELECT * FROM `user` WHERE `time` <= '".time()."' and `time` != '0'");
while ($row = mysqli_fetch_assoc($query)) {
    $link->query("UPDATE `user` SET `time`='0', `peremen`='4' WHERE user_id = '".$row['user_id']."'");
    $kbd = [
        'inline' => true,
        'buttons' => [
            [getBtn("🎗24 часа за 49₽", 'primary', '24ч')],
            [getBtn("🥉7 дней за 99₽", 'primary', '7д')],
            [getBtn("🥈30 дней за 129₽", 'primary', '30д')],
            [getBtn("🥇Навсегда за 299₽", 'primary', 'Навсегда')],
        ]
    ];
    message($row['user_id'],'⚡️ Временная акция специально для ВАС!<br><br>Скидка на VIP: 50%',$kbd);

}
$query = mysqli_query($link,"SELECT * FROM `user` WHERE `vip` <= '".time()."' and `vip` != '0'");
while ($row = mysqli_fetch_assoc($query)) {
    $link->query("UPDATE `user` SET `vip`='0' WHERE user_id = '".$row['user_id']."'");
    message($row['user_id'],'😥К сожалению, ваш vip-статус закончился');

}
$query = mysqli_query($link,"SELECT * FROM `user` WHERE `ban_time` <= '".time()."' and `ban_time` != '0'");
while ($row = mysqli_fetch_assoc($query)) {
    $link->query("UPDATE `user` SET `ban_time`='' WHERE user_id = '".$row['user_id']."'");
    message($row['user_id'],'😉Ваш срок бана истек');
}
?>