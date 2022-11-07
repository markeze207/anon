<?
$link->query("UPDATE `user` SET `peremen` = '1' WHERE user_id = '".$user_id."'");
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("Отменить", 'primary', 'Отменить_возраст')],
    ]
];
message($user_id,'Укажи свой возраст',$kbd);

?>