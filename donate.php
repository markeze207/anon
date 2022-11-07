<?
// файл для выдачи вип, после самой оплаты
$amount = '149'; // Получить информацию о сумме пополнения
$user_id = '334626026'; // Получить айдишник
require_once('publick.php');
$link = new mysqli('localhost', 'root', 'PASSWORD_BD', 'anon_chat');
$token = ''; // TOKEN VK
$query = "SELECT `user_id` FROM `user` WHERE user_id = '".$user_id."'";
$sql = mysqli_query ($link,$query);  
if (mysqli_num_rows($sql) > 0){
    $user = mysqli_fetch_assoc($link->query("SELECT * FROM `user` WHERE user_id = $user_id"));
    $kbd = [
        'one_time' => false,
        'buttons' => [
            [getBtn("🎲Случайный собеседник", 'secondary', 'Случайный')],
            [getBtn("❤️Поиск по полу", 'secondary', 'По_полу'), getBtn("😈 Пошлый чат",'secondary','Пошлый_чат')],
            [getBtn("🛠 Профиль", 'secondary', 'Профиль')],
        ]
    ];
    if($amount == '79' or $amoun = '49'){
        $time = time() + 60*60*24;
        $link->query("UPDATE `user` SET `vip`='".$time."' WHERE user_id = '".$user_id."'");
        message($user_id,'👑 Ты купил VIP на 24ч.',$kbd);
        die('OK');
    }
    elseif($amount == '149' or $amoun == '99'){
        $time = time() + 60*60*24*7;
        $link->query("UPDATE `user` SET `vip`='".$time."' WHERE user_id = '".$user_id."'");
        message($user_id,'👑 Ты купил VIP на 7д.',$kbd);
        die('OK');

    }
    elseif($amount == '179' or $amount == '129'){
        $time = time() + 60*60*24*30;
        $link->query("UPDATE `user` SET `vip`='".$time."' WHERE user_id = '".$user_id."'");
        message($user_id,'👑 Ты купил VIP на 30д.',$kbd);
        die('OK');

    }
    elseif($amount == '499' or $amount == '299'){
        $time = time() + 60*60*24*1000;
        $link->query("UPDATE `user` SET `vip`='".$time."' WHERE user_id = '".$user_id."'");
        message($user_id,'👑 Ты купил VIP навсегда.',$kbd);
        die('OK');

    }
}
?>