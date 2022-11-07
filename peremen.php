<?
if($user['peremen'] == 1) {
    if($message <= '0' or $message > 99) {
        message($user_id,'Ваш возраст не должен равняться или быть ниже 0 или больше 99');
        die('OK');
    }
    elseif(ctype_alpha($message) === true) {
        message($user_id,'Возраст не может состоять из букв');
        die('OK');
    } else {
        $link->query("UPDATE `user` SET `old`='".$message."',`peremen` = '0' WHERE user_id = '".$user_id."'");
        $kbd = [
            'one_time' => false,
            'buttons' => [
                [getBtn("🎲Случайный собеседник", 'secondary', 'Случайный')],
                [getBtn("❤️Поиск по полу", 'secondary', 'По_полу'), getBtn("😈 Пошлый чат",'secondary','Пошлый_чат')],
                [getBtn("🛠 Профиль", 'secondary', 'Профиль')],
            ]
        ];
        if($user['old'] > 0) {
            message($user_id,'Ты успешно сменил возраст',$kbd);
            die('OK');
        } else {
            message($user_id,'⚡️Выбери действие:',$kbd);
            die('OK');
        }
    }
}
elseif($user['peremen'] == 2) {
    if($message == $user['captcha']) {
        $link->query("UPDATE `user` SET `captcha`='0',`peremen`='0' WHERE user_id = '".$user_id."'");
        message($user_id,'🤖Ты прошел проверку на робота');
        die('OK');
    }
    else {
        message($user_id,'🤖Увы, но капча введена неверно');
    }
    die('OK');
}
elseif($user['peremen'] == 3) {
    $link->query("INSERT INTO `ban`(`name`) VALUES ('".$message."')");	
    message($user_id,'Добавлено');
    die('OK');
}
?>