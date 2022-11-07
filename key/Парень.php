<?
if($user['old'] > 0) {
    $link->query("UPDATE `user` SET `sex`='Мужской' WHERE user_id = '".$user_id."'");
    message($user_id,'Ты успешно изменил свой пол');
} else {
    $link->query("UPDATE `user` SET `peremen`='1', `sex`='Мужской' WHERE user_id = '".$user_id."'");
    $result = mysqli_query ($link,$query);  
    $kbd = [
        'one_time' => false,
        'buttons' => [
            [getBtn("Назад", 'secondary', 'Назад')],
        ]
    ];
    message($user_id,'Укажи свой возраст',$kbd);
}
?>