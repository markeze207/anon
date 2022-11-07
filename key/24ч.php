<?
if($user['peremen']  == '4') {
    $link->query("UPDATE `user` SET `peremen`=`0` WHERE user_id = '".$user_id."'");
    $amount = '49';
} else {
    $amount = '79';
}
$request_params = array( 
    'url' => 'https://google.com', // ссылка на оплату
    'access_token' => $token, 
    'private' => '0',
    'v' => '5.111',
); 
$get_params = http_build_query($request_params); 
$info_vixod = file_get_contents('https://api.vk.com/method/utils.getShortLink?'. $get_params); 
$json = json_decode($info_vixod,true);
$ssilka = $json['response']['short_url'];
$kbd = [
    'inline' => true,
    'buttons' => [
         [getBtnlink("Купить", 'positive', $ssilka)],
         [getBtn("Назад", 'primary','Купить_вип')],
    ]
];	
message($user_id,'⭐ Ты собираешься купить "VIP" на 24ч.<br><br>💶 Сумма к оплате: ' .$amount. ' рублей<br><br>',$kbd);

?>