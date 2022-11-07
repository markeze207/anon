<?
$kbd = [
    'inline' => true,
    'buttons' => [
        [getBtn("🙋‍♂️Парень", 'primary', 'Парень'),getBtn("🙋‍♀️Девушка", 'positive', 'Девушка')],
    ]
];
message($user_id,'Укажи свой пол',$kbd);
?>