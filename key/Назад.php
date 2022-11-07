<?php
$kbd = [
    'one_time' => false,
    'buttons' => [
        [getBtn("Парень", 'secondary', 'Парень'),getBtn("Девушка", 'positive', 'Девушка')],
    ]
];
message($user_id,'Укажи свой пол',$kbd);

?>